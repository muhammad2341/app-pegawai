@extends('master')
@section('title', 'Detail Departemen')
@section('content')
    <h1>Detail Departemen</h1>
    <p>Nama: {{ $department->nama_departemen }}</p>
    <a href="{{ route('admin.departments.index') }}">Kembali ke Daftar</a>
@endsection