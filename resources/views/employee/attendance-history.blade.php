@extends('master')

@section('title', 'Riwayat Absensi')
@section('page-title', 'Riwayat Absensi Saya')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Riwayat Absensi</h2>
        <a href="{{ route('employee.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    @if($attendances->isEmpty())
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded">
            <p><i class="fas fa-info-circle mr-2"></i>Belum ada riwayat absensi.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-700">No</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-700">Hari</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-700">Waktu Masuk</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-700">Waktu Keluar</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-700">Durasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $index => $attendance)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $attendances->firstItem() + $index }}</td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($attendance->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($attendance->tanggal)->locale('id')->isoFormat('dddd') }}
                            </td>
                            <td class="py-3 px-4 border-b text-sm">
                                @if($attendance->waktu_masuk)
                                    <span class="text-green-600 font-semibold">
                                        <i class="fas fa-sign-in-alt mr-1"></i>{{ $attendance->waktu_masuk }}
                                    </span>
                                @else
                                    <span class="text-gray-400">--:--</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b text-sm">
                                @if($attendance->waktu_keluar)
                                    <span class="text-blue-600 font-semibold">
                                        <i class="fas fa-sign-out-alt mr-1"></i>{{ $attendance->waktu_keluar }}
                                    </span>
                                @else
                                    <span class="text-gray-400">--:--</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b text-sm">
                                @php
                                    $statusClass = match($attendance->status_absensi) {
                                        'Hadir' => 'bg-green-100 text-green-800',
                                        'Sakit' => 'bg-blue-100 text-blue-800',
                                        'Izin' => 'bg-yellow-100 text-yellow-800',
                                        'Alfa' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                    {{ $attendance->status_absensi }}
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">
                                @if($attendance->waktu_masuk && $attendance->waktu_keluar)
                                    @php
                                        $masuk = \Carbon\Carbon::parse($attendance->waktu_masuk);
                                        $keluar = \Carbon\Carbon::parse($attendance->waktu_keluar);
                                        $durasi = $masuk->diff($keluar);
                                        $jam = $durasi->h;
                                        $menit = $durasi->i;
                                    @endphp
                                    <span class="text-indigo-600 font-semibold">
                                        <i class="fas fa-clock mr-1"></i>{{ $jam }}j {{ $menit }}m
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">
                                @if($attendance->tanggal == now()->toDateString() && $attendance->waktu_masuk && !$attendance->waktu_keluar)
                                    <form method="POST" action="{{ route('employee.attendance.cancel', $attendance->id) }}" onsubmit="return confirm('Batalkan absensi hari ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs">Batalkan</button>
                                    </form>
                                @else
                                    <span class="text-gray-300 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $attendances->links() }}
        </div>

        {{-- Statistik Ringkasan --}}
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold text-gray-700 mb-3">Ringkasan</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-600">{{ $attendances->where('status_absensi', 'Hadir')->count() }}</p>
                    <p class="text-xs text-gray-600">Hadir</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-yellow-600">{{ $attendances->where('status_absensi', 'Izin')->count() }}</p>
                    <p class="text-xs text-gray-600">Izin</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ $attendances->where('status_absensi', 'Sakit')->count() }}</p>
                    <p class="text-xs text-gray-600">Sakit</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-red-600">{{ $attendances->where('status_absensi', 'Alfa')->count() }}</p>
                    <p class="text-xs text-gray-600">Alfa</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
