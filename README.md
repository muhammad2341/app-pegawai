# 📊 Aplikasi Manajemen Pegawai

Aplikasi berbasis web untuk mengelola data pegawai, absensi, gaji, departemen, dan posisi. Dibangun dengan Laravel 11 dan Tailwind CSS.

## ✨ Fitur Utama

### 👨‍💼 Role Admin

-   ✅ Manajemen data karyawan (CRUD)
-   ✅ Manajemen departemen
-   ✅ Manajemen posisi/jabatan
-   ✅ Manajemen gaji karyawan
-   ✅ Monitoring absensi semua karyawan
-   ✅ Dashboard dengan statistik

### 👷 Role Karyawan

-   ✅ Absen masuk/keluar dengan 1 klik
-   ✅ Riwayat absensi pribadi
-   ✅ Statistik kehadiran bulanan
-   ✅ Dashboard personal

## 🛠️ Teknologi yang Digunakan

-   **Framework:** Laravel 11
-   **Database:** MySQL
-   **Frontend:** Blade Template, Tailwind CSS
-   **Authentication:** Laravel Breeze
-   **Icons:** Font Awesome

## 📋 Prasyarat

-   PHP >= 8.2
-   Composer
-   MySQL/MariaDB
-   Node.js & NPM

## 🚀 Instalasi

1. **Clone repository**

```bash
git clone https://github.com/muhammad2341/app-pegawai.git
cd app-pegawai
```

2. **Install dependencies**

```bash
composer install
npm install
```

3. **Copy file environment**

```bash
cp .env.example .env
```

4. **Generate application key**

```bash
php artisan key:generate
```

5. **Konfigurasi database**
   Edit file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app_pegawai
DB_USERNAME=root
DB_PASSWORD=
```

6. **Jalankan migration & seeder**

```bash
php artisan migrate
php artisan db:seed --class=AdminSeeder
```

7. **Build assets**

```bash
npm run build
```

atau untuk development:

```bash
npm run dev
```

8. **Jalankan server**

```bash
php artisan serve
```

Aplikasi dapat diakses di: `http://localhost:8000`

## 👤 Akun Default

### Admin

-   **Email:** admin@example.com
-   **Password:** 123456

### Karyawan

-   **Email:** (sesuai data employee)
-   **Password:** password123

## 📁 Struktur Database

### Tabel Utama:

-   `users` - Data user & autentikasi
-   `employees` - Data karyawan
-   `departments` - Data departemen
-   `positions` - Data posisi/jabatan
-   `attendances` - Data absensi
-   `salaries` - Data gaji

## 🔐 Role & Permission

### Admin (role: 'admin')

-   Full access ke semua fitur
-   Routes: `/admin/*`

### Karyawan (role: 'karyawan')

-   Akses terbatas untuk absensi
-   Routes: `/employee/*`

## 📝 Cara Menambahkan User Karyawan Baru

**Opsi 1: Via Seeder (Otomatis)**

```bash
php artisan db:seed --class=EmployeeUserSeeder
```

**Opsi 2: Manual**

1. Tambahkan data employee via admin panel
2. Buat user manual dengan employee_id yang sesuai

## 🎨 Fitur Absensi Karyawan

### Cara Kerja:

1. Karyawan login ke sistem
2. Di dashboard, klik **"Absen Masuk"**
3. Sistem otomatis mencatat waktu masuk
4. Saat pulang, klik **"Absen Keluar"**
5. Sistem otomatis mencatat waktu keluar

### Validasi:

-   ✅ Tidak bisa absen 2x di hari yang sama
-   ✅ Harus absen masuk dulu sebelum absen keluar
-   ✅ Waktu tercatat otomatis

## 📚 Dokumentasi Tambahan

Lihat file [SETUP_MULTI_ROLE.md](SETUP_MULTI_ROLE.md) untuk panduan detail tentang sistem multi-role.

## 🐛 Troubleshooting

### Error: Column 'employee_id' not found

```bash
php artisan migrate
```

### Error: Class not found

```bash
composer dump-autoload
```

### CSS tidak muncul

```bash
npm run build
```

## 📈 Pengembangan Selanjutnya

Fitur yang bisa ditambahkan:

-   [ ] Export data ke Excel/PDF
-   [ ] Sistem cuti karyawan
-   [ ] Notifikasi email
-   [ ] Upload dokumen karyawan
-   [ ] Laporan gaji bulanan
-   [ ] Dashboard analytics
-   [ ] Mobile responsive improvement
-   [ ] REST API untuk mobile app

## 📄 License

MIT License - Bebas digunakan untuk keperluan pembelajaran dan pengembangan.

## 👨‍💻 Developer

Muhammad - Workshop Pemrograman Framework, Semester 3

## 🤝 Kontribusi

Contributions, issues, dan feature requests sangat diterima!

---

**Happy Coding! 🚀**
