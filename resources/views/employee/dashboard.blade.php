@extends('master')

@section('title', 'Dashboard Karyawan')
@section('page-title', 'Dashboard Karyawan')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Welcome Card --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-gray-600">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ Auth::user()->employee->position->nama_jabatan ?? 'Karyawan' }} - {{ Auth::user()->employee->department->department_name ?? '' }}</p>
            <div class="mt-4">
                <a href="{{ route('employee.profile.edit') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded shadow">
                    Edit Profil Saya
                </a>
            </div>
    </div>

    {{-- Status Absensi Hari Ini --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Absensi Hari Ini</h3>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Status Waktu Masuk --}}
            <div class="border rounded-lg p-4 {{ $todayAttendance && $todayAttendance->waktu_masuk ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200' }}">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Waktu Masuk</p>
                        <p class="text-2xl font-bold {{ $todayAttendance && $todayAttendance->waktu_masuk ? 'text-green-600' : 'text-gray-400' }}">
                            {{ $todayAttendance && $todayAttendance->waktu_masuk ? $todayAttendance->waktu_masuk : '--:--' }}
                        </p>
                    </div>
                    <div>
                        @if($todayAttendance && $todayAttendance->waktu_masuk)
                            <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                        @else
                            <i class="fas fa-clock text-gray-400 text-3xl"></i>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Status Waktu Keluar --}}
            <div class="border rounded-lg p-4 {{ $todayAttendance && $todayAttendance->waktu_keluar ? 'bg-blue-50 border-blue-200' : 'bg-gray-50 border-gray-200' }}">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Waktu Keluar</p>
                        <p class="text-2xl font-bold {{ $todayAttendance && $todayAttendance->waktu_keluar ? 'text-blue-600' : 'text-gray-400' }}">
                            {{ $todayAttendance && $todayAttendance->waktu_keluar ? $todayAttendance->waktu_keluar : '--:--' }}
                        </p>
                    </div>
                    <div>
                        @if($todayAttendance && $todayAttendance->waktu_keluar)
                            <i class="fas fa-check-circle text-blue-500 text-3xl"></i>
                        @else
                            <i class="fas fa-clock text-gray-400 text-3xl"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Absensi --}}
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Tombol Absen Masuk --}}
            @if(!$todayAttendance || !$todayAttendance->waktu_masuk)
                <form action="{{ route('employee.attendance.clockIn') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Absen Masuk
                    </button>
                </form>
            @else
                <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-4 px-6 rounded-lg shadow cursor-not-allowed">
                    <i class="fas fa-check mr-2"></i>
                    Sudah Absen Masuk
                </button>
            @endif

            {{-- Tombol Absen Keluar --}}
            @if($todayAttendance && $todayAttendance->waktu_masuk && !$todayAttendance->waktu_keluar)
                <form action="{{ route('employee.attendance.clockOut') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Absen Keluar
                    </button>
                </form>
                <form action="{{ route('employee.attendance.cancel', $todayAttendance->id) }}" method="POST" onsubmit="return confirm('Batalkan absensi masuk hari ini?')" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-200">
                        <i class="fas fa-times mr-2"></i>Batalkan Absensi Masuk
                    </button>
                </form>
            @elseif($todayAttendance && $todayAttendance->waktu_keluar)
                <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-4 px-6 rounded-lg shadow cursor-not-allowed">
                    <i class="fas fa-check mr-2"></i>
                    Sudah Absen Keluar
                </button>
            @else
                <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-4 px-6 rounded-lg shadow cursor-not-allowed">
                    <i class="fas fa-lock mr-2"></i>
                    Absen Masuk Dulu
                </button>
            @endif
        </div>

        {{-- Info Tambahan --}}
        <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
                <i class="fas fa-info-circle mr-2"></i>
                <strong>Info:</strong> Jangan lupa absen masuk saat tiba di kantor dan absen keluar saat pulang!
            </p>
        </div>
    </div>

    {{-- Ringkasan Absensi Bulan Ini --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Ringkasan Absensi Bulan Ini</h3>
            <a href="{{ route('employee.attendance.history') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                <i class="fas fa-history mr-1"></i>Lihat Semua Riwayat
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <p class="text-3xl font-bold text-green-600">{{ $monthlyStats['hadir'] }}</p>
                <p class="text-sm text-gray-600 mt-1">Hadir</p>
            </div>
            <div class="text-center p-4 bg-yellow-50 rounded-lg">
                <p class="text-3xl font-bold text-yellow-600">{{ $monthlyStats['izin'] }}</p>
                <p class="text-sm text-gray-600 mt-1">Izin</p>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <p class="text-3xl font-bold text-blue-600">{{ $monthlyStats['sakit'] }}</p>
                <p class="text-sm text-gray-600 mt-1">Sakit</p>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <p class="text-3xl font-bold text-red-600">{{ $monthlyStats['alfa'] }}</p>
                <p class="text-sm text-gray-600 mt-1">Alfa</p>
            </div>
        </div>
    </div>
</div>
@endsection
