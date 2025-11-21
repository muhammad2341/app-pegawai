@extends('master')
@section('title', 'Detail Position')
@section('content')
<h1 class="text-xl font-bold mb-4">Detail Position</h1>
<p><strong>Nama Position:</strong> {{ $position->nama_position }}</p>
<a href="{{ route('admin.positions.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">Kembali</a>
@endsection
