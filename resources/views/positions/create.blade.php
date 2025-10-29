@extends('master')
@section('title', 'Tambah Position')
@section('content')
<h1 class="text-xl font-bold mb-4">Tambah Position</h1>

@if ($errors->any())
    <div class="text-red-600 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('positions.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf
    <div class="mb-4">
        <label class="block mb-1">Department:</label>
        <select name="department_id" required class="border p-2 w-full rounded">
            <option value="">-- Pilih Department --</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->nama_department }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Nama Position:</label>
        <input type="text" name="nama_position" value="{{ old('nama_position') }}" class="border p-2 w-full rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Gaji Pokok:</label>
        <input type="number" name="gaji_pokok" value="{{ old('gaji_pokok') }}" class="border p-2 w-full rounded" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 transition">Simpan</button>
</form>
@endsection
