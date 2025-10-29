@extends('master')
@section('title', 'Data Absensi')
@section('page-title', 'Data Absensi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
  <div class="flex justify-between mb-4">
    <h2 class="text-xl font-semibold">Riwayat Kehadiran</h2>
    <a href="{{ route('attendances.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Absensi</a>
  </div>

  <table class="min-w-full bg-white border border-gray-200 rounded-lg">
    <thead class="bg-blue-600 text-white">
      <tr>
        <th class="py-2 px-4 text-left">Nama Pegawai</th>
        <th class="py-2 px-4 text-left">Jabatan</th>
        <th class="py-2 px-4 text-left">Tanggal</th>
        <th class="py-2 px-4 text-left">Jam Masuk</th>
        <th class="py-2 px-4 text-left">Jam Keluar</th>
        <th class="py-2 px-4 text-left">Status</th>
        <th class="py-2 px-4 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($attendances as $attendance)
      <tr class="border-b hover:bg-gray-100">
        <td class="py-2 px-4">{{ $attendance->employee->nama_lengkap ?? '-' }}</td>
        <td class="py-2 px-4">{{ $attendance->employee->position->nama_jabatan ?? '-' }}</td>
        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }}</td>
        <td class="py-2 px-4">{{ $attendance->waktu_masuk }}</td>
        <td class="py-2 px-4">{{ $attendance->waktu_keluar ?? '-' }}</td>
        <td class="py-2 px-4">{{ ucfirst($attendance->status_absensi ?? '-') }}</td>
        <td class="py-2 px-4">
          <a href="{{ route('attendances.edit', $attendance->id) }}" class="text-blue-600 hover:underline">Edit</a> |
          <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Hapus data ini?')" class="text-red-600 hover:underline">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
