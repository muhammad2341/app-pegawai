@extends('master')

@section('title', 'Daftar Departemen')
@section('page-title', 'Daftar Departemen')

@section('content')
<div class="mb-4">
    <a href="{{ route('departments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 transition">Tambah Departemen</a>
</div>

@if(session('success'))
    <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Departemen</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($departments as $dept)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $dept->department_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                    <a href="{{ route('departments.show', $dept->id) }}" class="text-blue-600 hover:underline">Detail</a>
                    <a href="{{ route('departments.edit', $dept->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
