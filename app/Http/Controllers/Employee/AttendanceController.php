<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Absen Masuk (Clock In)
     */
    public function clockIn(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        // Cek apakah sudah absen hari ini
        $todayAttendance = Attendance::where('karyawan_id', $employee->id)
            ->whereDate('tanggal', Carbon::today())
            ->first();

        if ($todayAttendance && $todayAttendance->waktu_masuk) {
            return redirect()->route('employee.dashboard')
                ->with('error', 'Anda sudah absen masuk hari ini!');
        }

        // Jika belum ada record, buat baru
        if (!$todayAttendance) {
            Attendance::create([
                'karyawan_id' => $employee->id,
                'tanggal' => Carbon::today(),
                'waktu_masuk' => Carbon::now()->format('H:i'),
                'status_absensi' => 'Hadir',
            ]);
        } else {
            // Update waktu masuk jika record sudah ada tapi waktu_masuk masih null
            $todayAttendance->update([
                'waktu_masuk' => Carbon::now()->format('H:i'),
                'status_absensi' => 'Hadir',
            ]);
        }

        return redirect()->route('employee.dashboard')
            ->with('success', 'Absen masuk berhasil! Waktu: ' . Carbon::now()->format('H:i'));
    }

    /**
     * Absen Keluar (Clock Out)
     */
    public function clockOut(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        // Cek absensi hari ini
        $todayAttendance = Attendance::where('karyawan_id', $employee->id)
            ->whereDate('tanggal', Carbon::today())
            ->first();

        // Validasi: harus sudah absen masuk dulu
        if (!$todayAttendance || !$todayAttendance->waktu_masuk) {
            return redirect()->route('employee.dashboard')
                ->with('error', 'Anda harus absen masuk terlebih dahulu!');
        }

        // Validasi: sudah absen keluar
        if ($todayAttendance->waktu_keluar) {
            return redirect()->route('employee.dashboard')
                ->with('error', 'Anda sudah absen keluar hari ini!');
        }

        // Update waktu keluar
        $todayAttendance->update([
            'waktu_keluar' => Carbon::now()->format('H:i'),
        ]);

        return redirect()->route('employee.dashboard')
            ->with('success', 'Absen keluar berhasil! Waktu: ' . Carbon::now()->format('H:i'));
    }

    /**
     * Tampilkan riwayat absensi karyawan
     */
    public function history()
    {
        $user = Auth::user();
        $employee = $user->employee;

        $attendances = Attendance::where('karyawan_id', $employee->id)
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        return view('employee.attendance-history', compact('attendances'));
    }

    /**
     * Batalkan absensi hari ini sebelum waktu_keluar diisi.
     */
    public function cancel(Request $request, $id)
    {
        $user = Auth::user();
        $employee = $user->employee;

        $attendance = Attendance::where('id', $id)
            ->where('karyawan_id', $employee->id)
            ->first();

        if (!$attendance) {
            return redirect()->route('employee.attendance.history')->with('error', 'Data absensi tidak ditemukan.');
        }

        // Hanya dapat dibatalkan jika tanggal = hari ini dan belum isi waktu_keluar
        if ($attendance->tanggal != now()->toDateString()) {
            return redirect()->route('employee.attendance.history')->with('error', 'Hanya absensi hari ini yang bisa dibatalkan.');
        }
        if ($attendance->waktu_keluar) {
            return redirect()->route('employee.attendance.history')->with('error', 'Tidak dapat membatalkan setelah absen keluar.');
        }

        $attendance->delete();
        return redirect()->route('employee.attendance.history')->with('success', 'Absensi berhasil dibatalkan.');
    }
}
