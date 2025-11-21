@extends('master')
@section('title', 'Edit Departemen')
@section('content')
    <h1>Edit Departemen: {{ $department->department_name }}</h1>
    <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="department_name">Nama Departemen:</label>
        <input type="text" name="department_name" value="{{ old('department_name', $department->department_name) }}" required><br>
        <button type="submit">Update</button>
    </form>
@endsection
