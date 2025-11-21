@extends('master')
@section('title', 'Detail Salary')
@section('page-title', 'Detail Salary')
@section('content')

<div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
    <h2 class="text-xl font-bold mb-4">Detail Salary</h2>

    <table class="w-full text-left">
        <tr class="border-b">
            <th class="py-2">Karyawan</th>
            <td class="py-2">{{ $salary->employee->nama_lengkap ?? '-' }}</td>
        </tr>
        <tr class="border-b">
            <th class="py-2">Jabatan</th>
            <td class="py-2">{{ $salary->position->nama_jabatan ?? $salary->employee->position->nama_jabatan ?? '-' }}</td>
        </tr>
        <tr class="border-b">
            <th class="py-2">Bulan</th>
            <td class="py-2">{{ \Carbon\Carbon::parse($salary->bulan)->format('F Y') }}</td>
        </tr>
        <tr class="border-b">
            <th class="py-2">Gaji Pokok</th>
            <td class="py-2">{{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
        </tr>
        <tr class="border-b">
            <th class="py-2">Tunjangan</th>
            <td class="py-2">{{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
        </tr>
        <tr class="border-b">
            <th class="py-2">Potongan</th>
            <td class="py-2">{{ number_format($salary->potongan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th class="py-2">Total Gaji</th>
            <td class="py-2 font-semibold text-green-700">
                {{ number_format($salary->total_gaji, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div class="mt-4 flex space-x-2">
        <a href="{{ route('admin.salaries.edit', $salary->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-400">Edit</a>
        <form action="{{ route('admin.salaries.destroy', $salary->id) }}" method="POST" onsubmit="return confirm('Apakah yakin ingin menghapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400">Hapus</button>
        </form>
        <a href="{{ route('admin.salaries.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
    </div>
</div>

@endsection
