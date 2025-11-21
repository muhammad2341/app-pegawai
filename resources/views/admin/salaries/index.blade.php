@extends('master')
@section('title', 'Data Gaji Pegawai')
@section('page-title', 'Data Gaji Pegawai')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
  <div class="flex justify-between mb-4">
    <h2 class="text-xl font-semibold">Rekap Gaji</h2>
    <a href="{{ route('admin.salaries.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Gaji</a>
  </div>

  <table class="min-w-full bg-white border border-gray-200 rounded-lg">
    <thead class="bg-blue-600 text-white">
      <tr>
        <th class="py-2 px-4 text-left">Nama Pegawai</th>
        <th class="py-2 px-4 text-left">Jabatan</th>
        <th class="py-2 px-4 text-left">Bulan</th>
        <th class="py-2 px-4 text-left">Total Gaji</th>
        <th class="py-2 px-4 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($salaries as $salary)
      <tr class="border-b hover:bg-gray-100">
        <td class="py-2 px-4">{{ $salary->employee->nama_lengkap ?? '-' }}</td>
        <td class="py-2 px-4">{{ $salary->position->nama_jabatan ?? $salary->employee->position->nama_jabatan ?? '-' }}</td>
        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($salary->bulan)->format('F Y') }}</td>
        <td class="py-2 px-4">{{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
        <td class="py-2 px-4">
          <a href="{{ route('admin.salaries.edit', $salary->id) }}" class="text-blue-600 hover:underline">Edit</a> |
          <form action="{{ route('admin.salaries.destroy', $salary->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="text-red-600 hover:underline">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-4">
      {{ $salaries->links() }}
  </div>
</div>
@endsection
