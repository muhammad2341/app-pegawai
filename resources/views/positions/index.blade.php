@extends('master')
@section('title', 'Daftar Jabatan')
@section('page-title', 'Daftar Jabatan')

@section('content')
<div class="mb-4">
    <a href="{{ route('positions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 transition">Tambah Jabatan</a>
</div>

<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-6 py-3 text-left">Nama Jabatan</th>
            <th class="px-6 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($positions as $position)
        <tr class="border-b">
            <td class="px-6 py-4">{{ $position->nama_jabatan }}</td>
            <td class="px-6 py-4 space-x-2">
                <a href="{{ route('positions.edit', $position->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
