@extends('master')
@section('title', 'Edit Salary')
@section('page-title', 'Edit Salary')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Edit Salary</h1>

    <form action="{{ route('salaries.edit', $salary->id) }}" method="GET" class="bg-white p-6 rounded shadow mb-6">
        <div class="flex gap-4">
            <div class="w-1/2">
                <label class="block font-semibold mb-2">Pilih Jabatan</label>
                <select name="position_id" class="w-full border p-2 rounded" onchange="this.form.submit()">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ $selectedPositionId == $position->id ? 'selected' : '' }}>
                            {{ $position->nama_jabatan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/2">
                <label class="block font-semibold mb-2">Pilih Karyawan</label>
                <select name="karyawan_id" class="w-full border p-2 rounded" onchange="this.form.submit()">
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}" {{ $selectedEmployeeId == $emp->id ? 'selected' : '' }}>
                            {{ $emp->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <form action="{{ route('salaries.update', $salary->id) }}" method="POST" class="bg-white p-8 rounded shadow-lg">
        @csrf
        @method('PUT')
        <input type="hidden" name="karyawan_id" value="{{ $selectedEmployeeId }}">
        <input type="hidden" name="position_id" value="{{ $selectedPositionId }}">

        <div class="mb-4">
            <label class="block font-semibold mb-2">Bulan</label>
            <input type="month" name="bulan" value="{{ $salary->bulan }}" class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tunjangan</label>
            <input type="number" name="tunjangan" value="{{ $salary->tunjangan }}" class="border p-2 w-full rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Potongan</label>
            <input type="number" name="potongan" value="{{ $salary->potongan }}" class="border p-2 w-full rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-500">
            Update
        </button>
    </form>
</div>
@endsection
