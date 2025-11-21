@extends('master')
@section('title','Detail Attendance')
@section('page-title','Detail Attendance')
@section('content')

<h1 class="mb-4">Detail Attendance</h1>

<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <tr>
        <th class="px-6 py-3 text-left">Karyawan</th>
        <td class="px-6 py-3">{{ $attendance->employee->nama_lengkap ?? '-' }}</td>
    </tr>
    <tr>
        <th class="px-6 py-3 text-left">Jabatan</th>
        <td class="px-6 py-3">{{ $attendance->employee->position->nama_jabatan ?? '-' }}</td>
    </tr>
    <tr>
        <th class="px-6 py-3 text-left">Tanggal</th>
        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }}</td>
    </tr>
    <tr>
        <th class="px-6 py-3 text-left">Waktu Masuk</th>
        <td class="px-6 py-3">{{ $attendance->waktu_masuk }}</td>
    </tr>
    <tr>
        <th class="px-6 py-3 text-left">Waktu Keluar</th>
        <td class="px-6 py-3">{{ $attendance->waktu_keluar ?? '-' }}</td>
    </tr>
    <tr>
        <th class="px-6 py-3 text-left">Status Absensi</th>
        <td class="px-6 py-3">{{ ucfirst($attendance->status_absensi ?? '-') }}</td>
    </tr>
</table>

<div class="mt-4">
    <a href="{{ route('admin.attendances.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</a>
</div>

@endsection
