# 🚀 Cara Setup Sistem Multi-Role Login

## Langkah-langkah Setup:

### 1️⃣ Jalankan Migration Baru

```bash
php artisan migrate
```

### 2️⃣ Jalankan Seeder untuk Membuat User Admin

```bash
php artisan db:seed --class=AdminSeeder
```

### 3️⃣ Jalankan Seeder untuk Membuat User Karyawan (Opsional)

**Catatan:** Pastikan sudah ada data di tabel `employees` terlebih dahulu!

```bash
php artisan db:seed --class=EmployeeUserSeeder
```

---

## 📋 Akun Login Default:

### Admin:

-   **Email:** admin@example.com
-   **Password:** 123456
-   **Akses:** Full access ke semua fitur (employees, departments, positions, salaries, attendances)

### Karyawan:

-   **Email:** (sesuai email di tabel employees)
-   **Password:** password123 (default untuk semua karyawan)
-   **Akses:** Hanya bisa absen masuk/keluar dan lihat riwayat absensi sendiri

---

## ✨ Fitur yang Sudah Ditambahkan:

### Untuk ADMIN:

✅ Mengelola semua data employees  
✅ Mengelola departments  
✅ Mengelola positions  
✅ Mengelola salaries  
✅ Melihat & mengelola semua absensi karyawan  
✅ Dashboard dengan statistik

### Untuk KARYAWAN:

✅ Dashboard dengan tombol absen masuk/keluar  
✅ Absen masuk (clock in) dengan 1 klik  
✅ Absen keluar (clock out) dengan 1 klik  
✅ Melihat riwayat absensi pribadi  
✅ Statistik absensi bulan ini  
✅ Validasi: tidak bisa absen 2x di hari yang sama  
✅ Validasi: harus absen masuk dulu sebelum absen keluar

---

## 🔄 Alur Kerja Sistem:

### Login:

1. User login dengan email & password
2. Sistem otomatis redirect berdasarkan role:
    - Admin → `/admin/dashboard`
    - Karyawan → `/employee/dashboard`

### Absensi Karyawan:

1. Karyawan login ke sistem
2. Di dashboard, klik tombol **"Absen Masuk"**
3. Sistem mencatat waktu masuk otomatis
4. Saat pulang, klik tombol **"Absen Keluar"**
5. Sistem mencatat waktu keluar otomatis
6. Data absensi tersimpan di database dan bisa dilihat admin

### Admin Melihat Absensi:

1. Admin login ke sistem
2. Masuk ke menu **Attendances**
3. Melihat semua data absensi karyawan
4. Bisa edit/hapus jika ada kesalahan

---

## 📁 File-file Baru yang Ditambahkan:

### Migrations:

-   `2025_11_20_000001_add_employee_id_to_users_table.php`

### Seeders:

-   `EmployeeUserSeeder.php`

### Controllers:

-   `app/Http/Controllers/Employee/AttendanceController.php`

### Views:

-   `resources/views/employee/dashboard.blade.php`
-   `resources/views/employee/attendance-history.blade.php`

### Models (Updated):

-   `app/Models/User.php` (ditambahkan relasi ke Employee)
-   `app/Models/Employee.php` (ditambahkan relasi ke User)

### Routes (Updated):

-   `routes/web.php` (ditambahkan route untuk employee attendance)

---

## 🎯 Routes yang Tersedia:

### Admin Routes (prefix: /admin):

-   `GET /admin/dashboard` - Dashboard admin
-   `RESOURCE /admin/employees` - CRUD employees
-   `RESOURCE /admin/departments` - CRUD departments
-   `RESOURCE /admin/positions` - CRUD positions
-   `RESOURCE /admin/salaries` - CRUD salaries
-   `RESOURCE /admin/attendances` - CRUD attendances (semua karyawan)

### Employee Routes (prefix: /employee):

-   `GET /employee/dashboard` - Dashboard karyawan
-   `POST /employee/attendance/clock-in` - Absen masuk
-   `POST /employee/attendance/clock-out` - Absen keluar
-   `GET /employee/attendance/history` - Riwayat absensi pribadi

---

## 🛠️ Cara Menambahkan User Karyawan Baru:

### Opsi 1: Manual via Database

1. Masukkan data employee di tabel `employees`
2. Buat user baru di tabel `users` dengan:
    - `email` = email employee
    - `password` = Hash::make('password')
    - `role` = 'karyawan'
    - `employee_id` = ID dari employee

### Opsi 2: Otomatis via Seeder

Jalankan seeder setiap kali ada employee baru:

```bash
php artisan db:seed --class=EmployeeUserSeeder
```

---

## 🔐 Security Features:

✅ Role-based access control (RBAC)  
✅ Middleware untuk proteksi route  
✅ Password hashing  
✅ CSRF protection  
✅ Validasi input  
✅ Prevent double attendance di hari yang sama

---

## 📝 Catatan Penting:

1. **Password Default:** Semua karyawan punya password default `password123`. Sebaiknya tambahkan fitur "ubah password" nanti.

2. **Relasi User-Employee:** Setiap user karyawan harus terhubung ke data employee via `employee_id`.

3. **Absensi Otomatis:** Waktu absensi tercatat otomatis saat tombol diklik (tidak perlu input manual).

4. **Status Absensi:** Saat clock in, status otomatis jadi "Hadir". Admin bisa edit jika ada yang sakit/izin.

---

## 🎨 Tampilan Dashboard Karyawan:

Dashboard karyawan menampilkan:

-   Greeting dengan nama karyawan
-   Tanggal hari ini
-   Status absen masuk/keluar hari ini
-   Tombol absen masuk (hijau)
-   Tombol absen keluar (biru)
-   Ringkasan absensi bulan ini (Hadir, Izin, Sakit, Alfa)

Tombol akan otomatis disabled jika sudah digunakan hari itu.

---

## 🚨 Troubleshooting:

### Error: "SQLSTATE[42S22]: Column not found: employee_id"

**Solusi:** Jalankan migration:

```bash
php artisan migrate
```

### Error: "Class EmployeeUserSeeder not found"

**Solusi:** Regenerate autoload:

```bash
composer dump-autoload
```

### User karyawan tidak bisa login

**Solusi:**

1. Cek di tabel users apakah ada user dengan role 'karyawan'
2. Pastikan employee_id terisi
3. Cek password sudah di-hash

---

Jika ada pertanyaan atau butuh penambahan fitur, silakan tanya! 😊
