@extends('master') 
@section('title','Tambah Attendance') 
@section('page-title','Tambah Attendance') 
@section('content') 

<h1 class="mb-4">Tambah Attendance</h1> 

@if ($errors->any()) 
    <div class="bg-red-200 text-red-800 p-2 rounded mb-4"> 
        <ul> 
            @foreach ($errors->all() as $error) 
                <li>- {{ $error }}</li> 
            @endforeach 
        </ul> 
    </div> 
@endif 

<form action="{{ route('attendances.store') }}" method="POST"> 
    @csrf 
    <div class="mb-2"> 
        <label>Karyawan</label> 
        <select name="karyawan_id" class="border px-2 py-1 rounded w-full"> 
            <option value="">-- Pilih Karyawan --</option> 
            @foreach($employees as $employee) 
                <option value="{{ $employee->id }}">
                    {{ $employee->nama_lengkap }} - {{ $employee->position->nama_jabatan ?? '-' }}
                </option> 
            @endforeach 
        </select> 
    </div> 

    <div class="mb-2"> 
        <label>Tanggal</label> 
        <input type="date" name="tanggal" class="border px-2 py-1 rounded w-full"> 
    </div> 

    <div class="mb-2"> 
        <label>Waktu Masuk</label> 
        <input type="time" name="waktu_masuk" class="border px-2 py-1 rounded w-full"> 
    </div> 

    <div class="mb-2"> 
        <label>Waktu Keluar</label> 
        <input type="time" name="waktu_keluar" class="border px-2 py-1 rounded w-full"> 
    </div> 

    <div class="mb-2"> 
        <label>Status Absensi</label> 
        <select name="status_absensi" class="border px-2 py-1 rounded w-full"> 
            <option value="">-- Pilih Status --</option> 
            <option value="Hadir">Hadir</option> 
            <option value="Sakit">Sakit</option> 
            <option value="Izin">Izin</option> 
            <option value="Alfa">Alfa</option> 
        </select> 
    </div> 

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">Simpan</button> 
</form> 

@endsection
