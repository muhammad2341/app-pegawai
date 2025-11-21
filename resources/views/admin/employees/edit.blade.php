@extends('master')
@section('title', 'Edit Pegawai')
@section('page-title', 'Edit Pegawai')

@section('content')
<h2 class="text-lg font-semibold mb-6">Form Edit Pegawai</h2>

@if ($errors->any())
<div class="bg-red-100 text-red-800 p-3 rounded mb-4">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.employees.update', $employee->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium mb-1">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Alamat</label>
        <textarea name="alamat" class="border rounded w-full p-2" rows="2">{{ old('alamat', $employee->alamat) }}</textarea>
    </div>

    <div>
        <label class="block font-medium mb-1">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" class="border rounded w-full p-2">
    </div>

    <div>
        <label class="block font-medium mb-1">Departemen</label>
        <select name="department_id" id="department_id" class="border rounded w-full p-2">
            <option value="">-- Pilih Departemen --</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}" {{ $employee->department_id == $dept->id ? 'selected' : '' }}>
                    {{ $dept->department_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium mb-1">Posisi</label>
        <select name="position_id" id="position_id" class="border rounded w-full p-2">
            <option value="">-- Pilih Posisi --</option>
            @foreach($positions as $pos)
                <option value="{{ $pos->id }}" {{ $employee->position_id == $pos->id ? 'selected' : '' }}>
                    {{ $pos->nama_jabatan }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium mb-1">Status</label>
        <select name="status" class="border rounded w-full p-2">
            <option value="Aktif" {{ $employee->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ $employee->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">
        Simpan Perubahan
    </button>
    <a href="{{ route('admin.employees.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">Batal</a>
</form>
@endsection