@extends('master')
@section('title', 'Edit Position')
@section('content')
<h1 class="text-xl font-bold mb-4">Edit Position: {{ $position->nama_position }}</h1>

@if ($errors->any())
<div class="text-red-600 mb-4">
    <ul>
        @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('positions.update', $position->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-1">Nama Position:</label>
        <input type="text" name="nama_position" value="{{ old('nama_position', $position->nama_position) }}" class="border p-2 w-full rounded">
    </div>
    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-500 transition">Update</button>
</form>
@endsection
