@extends('master')
@section('title', 'Beranda')
@section('page-title', 'APP MANAJEMEN PEGAWAI')
@section('content')
<div class="bg-white shadow-md rounded-lg p-6">

    <!-- Header Dashboard -->
    <div class="flex items-center mb-6">
        <i class="fas fa-user-circle text-4xl text-gray-700 mr-3"></i>
        <div>
            <h2 class="text-2xl font-bold">Dashboard</h2>
            <p class="text-gray-700">
                Selamat datang di aplikasi manajemen pegawai.
            </p>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded-lg shadow text-center">
            <h3 class="text-lg font-bold">Total Pegawai</h3>
            <p class="text-2xl">{{ $totalEmployees }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg shadow text-center">
            <h3 class="text-lg font-bold">Total Departemen</h3>
            <p class="text-2xl">{{ $totalDepartments }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg shadow text-center">
            <h3 class="text-lg font-bold">Total Posisi</h3>
            <p class="text-2xl">{{ $totalPositions }}</p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg shadow text-center">
            <h3 class="text-lg font-bold">Total Gaji</h3>
            <p class="text-2xl">Rp {{ number_format($totalSalary, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Navigasi Card / Shortcut -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <a href="{{ route('admin.employees.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg flex flex-col items-center transition">
            <i class="fas fa-users text-3xl mb-2 text-blue-600"></i>
            <span class="font-semibold text-gray-700">Employees</span>
        </a>
        <a href="{{ route('admin.departments.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg flex flex-col items-center transition">
            <i class="fas fa-building text-3xl mb-2 text-green-600"></i>
            <span class="font-semibold text-gray-700">Departments</span>
        </a>
        <a href="{{ route('admin.positions.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg flex flex-col items-center transition">
            <i class="fas fa-briefcase text-3xl mb-2 text-yellow-600"></i>
            <span class="font-semibold text-gray-700">Positions</span>
        </a>
        <a href="{{ route('admin.salaries.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg flex flex-col items-center transition">
            <i class="fas fa-dollar-sign text-3xl mb-2 text-purple-600"></i>
            <span class="font-semibold text-gray-700">Salaries</span>
        </a>
        <a href="{{ route('admin.attendances.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg flex flex-col items-center transition">
            <i class="fas fa-calendar-check text-3xl mb-2 text-pink-600"></i>
            <span class="font-semibold text-gray-700">Attendance</span>
        </a>
    </div>

    <!-- Pegawai terbaru -->
    <h3 class="text-lg font-bold mb-2">Pegawai Baru</h3>
    <ul class="list-disc pl-5">
        @foreach($recentEmployees as $emp)
            <li>{{ $emp->nama_lengkap }} - {{ $emp->position->nama_jabatan ?? '-' }} - {{ $emp->department->department_name ?? '-' }}</li>
        @endforeach
    </ul>
</div>
@endsection
