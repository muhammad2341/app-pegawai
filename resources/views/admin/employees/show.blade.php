@extends('master')
@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Pegawai')

@section('content')
<h2 class="text-xl font-semibold mb-6">Detail Pegawai</h2>

<div class="bg-white p-6 rounded-lg shadow-md">
    <table class="min-w-full border border-gray-200">
        <tr>
            <th class="text-left p-2 border-b">Nama Lengkap</th>
            <td class="p-2 border-b">{{ $employee->nama_lengkap }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border-b">Email</th>
            <td class="p-2 border-b">{{ $employee->email }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border-b">Nomor Telepon</th>
            <td class="p-2 border-b">{{ $employee->nomor_telepon }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border-b">Tanggal Lahir</th>
            <td class="p-2 border-b">{{ $employee->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border-b">Alamat</th>
            <td class="p-2 border-b">{{ $employee->alamat }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border-b">Tanggal Masuk</th>
            <td class="p-2 border-b">{{ $employee->tanggal_masuk }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border-b">Departemen</th>
            <td class="p-2 border-b">{{ $employee->department->department_name ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border-b">Jabatan</th>
            <td class="p-2 border-b">{{ $employee->position->nama_jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border-b">Status</th>
            <td class="p-2 border-b">{{ $employee->status }}</td>
        </tr>
    </table>

    <div class="mt-4">
        <a href="{{ route('admin.employees.edit', $employee->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-400">Edit</a>
        <a href="{{ route('admin.employees.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
    </div>
</div>
@endsection