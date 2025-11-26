@extends('master')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang di Aplikasi Manajemen Karyawan</h2>
    <p class="text-gray-600 mb-6">Pilih menu di atas untuk mengelola data pegawai, departemen, posisi, absensi, dan gaji.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.employees.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg shadow">
            <i class="fas fa-users text-2xl"></i>
            <p class="mt-2 font-semibold">Karyawan</p>
        </a>
        <a href="{{ route('admin.departments.index') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg shadow">
            <i class="fas fa-building text-2xl"></i>
            <p class="mt-2 font-semibold">Departemen</p>
        </a>
        <a href="{{ route('admin.positions.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-4 rounded-lg shadow">
            <i class="fas fa-briefcase text-2xl"></i>
            <p class="mt-2 font-semibold">Posisi</p>
        </a>
    </div>
</div>
@endsection
