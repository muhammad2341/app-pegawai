@extends('master')
@section('title', 'Daftar Pegawai')
@section('page-title', 'Daftar Pegawai')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
  <div class="flex justify-between mb-4">
    <h2 class="text-xl font-semibold">Data Pegawai</h2>
    <a href="{{ route('employees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Pegawai</a>
  </div>
  
  <table class="min-w-full bg-white border border-gray-200 rounded-lg">
    <thead class="bg-blue-600 text-white">
      <tr>
        <th class="py-2 px-4 text-left">Nama Lengkap</th>
        <th class="py-2 px-4 text-left">Jabatan</th>
        <th class="py-2 px-4 text-left">Departemen</th>
        <th class="py-2 px-4 text-left">Email</th>
        <th class="py-2 px-4 text-left">Nomor Telepon</th>
        <th class="py-2 px-4 text-left">Status</th>
        <th class="py-2 px-4 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($employees as $employee)
      <tr class="border-b hover:bg-gray-100">
        <td class="py-2 px-4">{{ $employee->nama_lengkap }}</td>
        <td class="py-2 px-4">{{ $employee->position->nama_jabatan ?? '-' }}</td>
        <td class="py-2 px-4">{{ $employee->department->department_name ?? '-' }}</td>
        <td class="py-2 px-4">{{ $employee->email }}</td>
        <td class="py-2 px-4">{{ $employee->nomor_telepon ?? '-' }}</td>
        <td class="py-2 px-4">{{ $employee->status }}</td>
        <td class="py-2 px-4">
          <a href="{{ route('employees.edit', $employee->id) }}" class="text-blue-600 hover:underline">Edit</a> |
          <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
