<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = $user->employee;

        // Jika user belum dikaitkan dengan data employee
        if (!$employee) {
            return view('employee.dashboard-pending', [
                'message' => 'Akun Anda sedang menunggu verifikasi dari Admin. Data karyawan Anda belum dibuat.'
            ]);
        }

        // Cek absensi hari ini
        $todayAttendance = Attendance::where('karyawan_id', $employee->id)
            ->whereDate('tanggal', Carbon::today())
            ->first();

        // Statistik absensi bulan ini
        $monthlyStats = [
            'hadir' => Attendance::where('karyawan_id', $employee->id)
                ->whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->where('status_absensi', 'Hadir')
                ->count(),
            'izin' => Attendance::where('karyawan_id', $employee->id)
                ->whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->where('status_absensi', 'Izin')
                ->count(),
            'sakit' => Attendance::where('karyawan_id', $employee->id)
                ->whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->where('status_absensi', 'Sakit')
                ->count(),
            'alfa' => Attendance::where('karyawan_id', $employee->id)
                ->whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->where('status_absensi', 'Alfa')
                ->count(),
        ];

        return view('employee.dashboard', compact('todayAttendance', 'monthlyStats'));
    }
}
