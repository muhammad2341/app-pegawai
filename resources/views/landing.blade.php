@extends('master')

@section('title', 'Aplikasi Manajemen Pegawai')
@section('page-title', 'Selamat Datang')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">Aplikasi Manajemen Pegawai</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Kelola data karyawan, departemen, posisi, gaji, dan absensi secara terpusat dengan mudah dan cepat.</p>
        @auth
            <div class="mt-6">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow">Masuk ke Dashboard Admin</a>
                @elseif(Auth::user()->role === 'karyawan')
                    <a href="{{ route('employee.dashboard') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow">Masuk ke Dashboard Karyawan</a>
                @endif
            </div>
        @endauth
        @guest
            <div class="mt-6 flex flex-wrap justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold px-6 py-3 rounded-lg shadow">Register</a>
                @endif
            </div>
        @endguest
    </div>

    <div class="grid md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
                <span class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg"><i class="fas fa-users"></i></span>
                <h3 class="ml-3 text-lg font-semibold text-gray-800">Manajemen Karyawan</h3>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">Tambah, edit, dan hapus data karyawan lengkap dengan jabatan, departemen, dan status kerja.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
                <span class="w-10 h-10 flex items-center justify-center bg-green-50 text-green-600 rounded-lg"><i class="fas fa-calendar-check"></i></span>
                <h3 class="ml-3 text-lg font-semibold text-gray-800">Absensi Real-Time</h3>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">Karyawan melakukan absen masuk & keluar dengan satu klik, tercatat otomatis untuk admin.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
                <span class="w-10 h-10 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-lg"><i class="fas fa-wallet"></i></span>
                <h3 class="ml-3 text-lg font-semibold text-gray-800">Pengelolaan Gaji</h3>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">Kelola informasi gaji karyawan dan integrasikan dengan data absensi untuk akurasi.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-10 mb-12 shadow border border-gray-100">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Fitur Utama</h2>
        <div class="grid md:grid-cols-2 gap-6 text-sm">
            <div class="flex items-start">
                <span class="mt-1 mr-3 text-blue-600"><i class="fas fa-user-shield"></i></span>
                <div>
                    <p class="font-semibold text-gray-700">Role-Based Access</p>
                    <p class="text-gray-600 leading-relaxed">Pemilahan hak akses antara Admin dan Karyawan: Admin mengelola data, Karyawan fokus pada absensi.</p>
                </div>
            </div>
            <div class="flex items-start">
                <span class="mt-1 mr-3 text-green-600"><i class="fas fa-fingerprint"></i></span>
                <div>
                    <p class="font-semibold text-gray-700">Absensi Satu Klik</p>
                    <p class="text-gray-600 leading-relaxed">Clock-in & clock-out instan, tercatat otomatis dan terintegrasi dengan laporan admin.</p>
                </div>
            </div>
            <div class="flex items-start">
                <span class="mt-1 mr-3 text-yellow-600"><i class="fas fa-coins"></i></span>
                <div>
                    <p class="font-semibold text-gray-700">Manajemen Gaji Terstruktur</p>
                    <p class="text-gray-600 leading-relaxed">Pencatatan komponen gaji yang dapat dikaitkan dengan data absensi dan status karyawan.</p>
                </div>
            </div>
            <div class="flex items-start">
                <span class="mt-1 mr-3 text-purple-600"><i class="fas fa-database"></i></span>
                <div>
                    <p class="font-semibold text-gray-700">Data Terpusat & Konsisten</p>
                    <p class="text-gray-600 leading-relaxed">Struktur database rapi mendukung pengembangan fitur lanjutan seperti cuti, laporan, dan export.</p>
                </div>
            </div>
            <div class="flex items-start">
                <span class="mt-1 mr-3 text-indigo-600"><i class="fas fa-chart-line"></i></span>
                <div>
                    <p class="font-semibold text-gray-700">Dashboard Informasional</p>
                    <p class="text-gray-600 leading-relaxed">Statistik absensi bulanan untuk karyawan dan overview data untuk admin (dapat dikembangkan lebih lanjut).</p>
                </div>
            </div>
            <div class="flex items-start">
                <span class="mt-1 mr-3 text-red-600"><i class="fas fa-lock"></i></span>
                <div>
                    <p class="font-semibold text-gray-700">Keamanan Dasar</p>
                    <p class="text-gray-600 leading-relaxed">Autentikasi Laravel + middleware role memastikan akses hanya sesuai peran.</p>
                </div>
            </div>
        </div>
        <div class="mt-8">
            @guest
                <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-700">Mulai Sekarang</a>
            @else
                <a href="{{ route('dashboard') }}" class="inline-block bg-gray-800 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-900">Masuk Dashboard</a>
            @endguest
        </div>
    </div>

    <div class="text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Aplikasi Manajemen Pegawai. Dibuat untuk efisiensi operasional.</p>
    </div>
</div>
@endsection