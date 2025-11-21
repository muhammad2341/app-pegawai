@extends('master')
@section('title','Edit Profil')
@section('page-title','Edit Profil Karyawan')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Perbarui Profil</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('employee.profile.update') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Departemen</label>
            <select name="department_id" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ $employee->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->department_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Jabatan / Posisi</label>
            <select name="position_id" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Posisi --</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ $employee->position_id == $pos->id ? 'selected' : '' }}>{{ $pos->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('employee.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>
@endsection