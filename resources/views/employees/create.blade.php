@extends('master')
@section('title', 'Tambah Pegawai')
@section('page-title', 'Tambah Pegawai')

@section('content')
<h2 class="text-lg font-semibold mb-6">Form Tambah Pegawai</h2>

@if ($errors->any())
<div class="bg-red-100 text-red-800 p-3 rounded mb-4">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block font-medium mb-1">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Alamat</label>
        <textarea name="alamat" class="border rounded w-full p-2" rows="2">{{ old('alamat') }}</textarea>
    </div>

    <div>
        <label class="block font-medium mb-1">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Departemen</label>
        <select name="department_id" class="border rounded w-full p-2">
            <option value="">-- Pilih Departemen --</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium mb-1">Posisi</label>
        <select name="position_id" class="border rounded w-full p-2">
            <option value="">-- Pilih Posisi --</option>
            @foreach($positions as $pos)
                <option value="{{ $pos->id }}">{{ $pos->nama_jabatan }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium mb-1">Status</label>
        <select name="status" class="border rounded w-full p-2">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">
        Simpan
    </button>
</form>
@endsection
