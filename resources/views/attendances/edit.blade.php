@extends('master')
@section('title','Edit Attendance')
@section('page-title','Edit Attendance')
@section('content')

<h1 class="mb-4">Edit Attendance</h1>

@if ($errors->any())
    <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>Karyawan</label>
        <select name="karyawan_id" class="border px-2 py-1 rounded w-full">
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ $employee->id == $attendance->karyawan_id ? 'selected' : '' }}>
                    {{ $employee->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label>Tanggal</label>
        <input type="date" name="tanggal" value="{{ $attendance->tanggal }}" class="border px-2 py-1 rounded w-full">
    </div>

    <div class="mb-2">
        <label>Waktu Masuk</label>
        <input type="time" name="waktu_masuk" value="{{ $attendance->waktu_masuk }}" class="border px-2 py-1 rounded w-full">
    </div>

    <div class="mb-2">
        <label>Waktu Keluar</label>
        <input type="time" name="waktu_keluar" value="{{ $attendance->waktu_keluar }}" class="border px-2 py-1 rounded w-full">
    </div>

    <div class="mb-2">
        <label>Status Absensi</label>
        <select name="status_absensi" class="border px-2 py-1 rounded w-full">
            <option value="Hadir" {{ $attendance->status_absensi == 'Hadir' ? 'selected' : '' }}>Hadir</option>
            <option value="Sakit" {{ $attendance->status_absensi == 'Sakit' ? 'selected' : '' }}>Sakit</option>
            <option value="Izin" {{ $attendance->status_absensi == 'Izin' ? 'selected' : '' }}>Izin</option>
            <option value="Alfa" {{ $attendance->status_absensi == 'Alfa' ? 'selected' : '' }}>Alfa</option>
        </select>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">Update</button>
</form>

@endsection
