@extends('master')

@section('title', 'Daftar Pegawai')

@section('page-title', 'Daftar Pegawai')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Lengkap</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nomor Telepon</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal Lahir</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Alamat</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal Masuk</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($employees as $employee)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->nama_lengkap }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->nomor_telepon }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->tanggal_lahir }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->alamat }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->tanggal_masuk }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
                        {{ $employee->status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $employee->status }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                    <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:underline">Detail</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
