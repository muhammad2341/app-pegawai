# ✅ Checklist Setup - Aplikasi Pegawai Multi-Role

Gunakan checklist ini untuk memastikan semua sudah berjalan dengan baik!

---

## 📋 Checklist Setup Database

-   [ ] Database MySQL sudah dibuat (nama: `app_pegawai` atau sesuai keinginan)
-   [ ] File `.env` sudah dikonfigurasi dengan benar:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=app_pegawai
    DB_USERNAME=root
    DB_PASSWORD=
    ```
-   [ ] Migration sudah dijalankan: `php artisan migrate`
-   [ ] Tabel `users` memiliki kolom `employee_id`
-   [ ] Tabel `employees` sudah ada
-   [ ] Tabel `attendances` sudah ada

---

## 👥 Checklist Seeder & User

-   [ ] Admin seeder sudah dijalankan: `php artisan db:seed --class=AdminSeeder`
-   [ ] Admin bisa login dengan:
    -   Email: `admin@example.com`
    -   Password: `123456`
-   [ ] Data employee sudah ditambahkan (minimal 1 employee untuk testing)
-   [ ] Employee user seeder sudah dijalankan: `php artisan db:seed --class=EmployeeUserSeeder`
-   [ ] User karyawan bisa login dengan email employee + password `password123`

---

## 🔧 Checklist Teknis

-   [ ] Composer dependencies sudah terinstall: `composer install`
-   [ ] NPM dependencies sudah terinstall: `npm install`
-   [ ] Application key sudah digenerate: `php artisan key:generate`
-   [ ] Assets sudah di-build: `npm run build` atau `npm run dev`
-   [ ] Autoload sudah di-refresh: `composer dump-autoload`
-   [ ] Cache sudah dibersihkan: `php artisan cache:clear`

---

## 🚀 Checklist Server & Akses

-   [ ] Server Laravel berjalan: `php artisan serve`
-   [ ] Aplikasi bisa diakses di: `http://localhost:8000`
-   [ ] Halaman login muncul dengan benar
-   [ ] CSS Tailwind sudah loaded dengan benar (tidak ada tampilan mentah)
-   [ ] Font Awesome icons muncul dengan benar

---

## 🔐 Checklist Login Admin

-   [ ] Bisa login sebagai admin
-   [ ] Redirect ke `/admin/dashboard` setelah login
-   [ ] Menu navigasi muncul (Employees, Departments, Positions, etc.)
-   [ ] Dashboard admin menampilkan card-card menu
-   [ ] Bisa akses halaman Employees
-   [ ] Bisa akses halaman Departments
-   [ ] Bisa akses halaman Positions
-   [ ] Bisa akses halaman Attendances
-   [ ] Bisa akses halaman Salaries

---

## 👷 Checklist Login Karyawan

-   [ ] Bisa login sebagai karyawan
-   [ ] Redirect ke `/employee/dashboard` setelah login
-   [ ] Dashboard karyawan muncul dengan benar
-   [ ] Welcome message menampilkan nama karyawan
-   [ ] Tanggal hari ini muncul dalam bahasa Indonesia
-   [ ] Card "Waktu Masuk" dan "Waktu Keluar" muncul
-   [ ] Tombol "Absen Masuk" (hijau) muncul dan aktif
-   [ ] Tombol "Absen Keluar" (biru) muncul tapi disabled/gray
-   [ ] Ringkasan statistik bulan ini muncul (Hadir, Izin, Sakit, Alfa)

---

## ✨ Checklist Fitur Absensi Karyawan

### Test Absen Masuk:

-   [ ] Klik tombol "Absen Masuk"
-   [ ] Muncul notifikasi success dengan waktu absen
-   [ ] Waktu masuk tercatat di card "Waktu Masuk"
-   [ ] Icon berubah menjadi ✓ (checkmark hijau)
-   [ ] Tombol "Absen Masuk" berubah jadi disabled
-   [ ] Tombol "Absen Keluar" menjadi aktif (biru)

### Test Absen Keluar:

-   [ ] Klik tombol "Absen Keluar"
-   [ ] Muncul notifikasi success dengan waktu keluar
-   [ ] Waktu keluar tercatat di card "Waktu Keluar"
-   [ ] Icon berubah menjadi ✓ (checkmark biru)
-   [ ] Tombol "Absen Keluar" berubah jadi disabled
-   [ ] Statistik "Hadir" bertambah 1

### Test Validasi:

-   [ ] Coba klik "Absen Masuk" lagi → Muncul error "sudah absen masuk"
-   [ ] Refresh halaman → Status tetap tersimpan
-   [ ] Logout dan login lagi → Status tetap tersimpan

---

## 📊 Checklist Riwayat Absensi

-   [ ] Link "Lihat Semua Riwayat" muncul di dashboard karyawan
-   [ ] Klik link → Redirect ke halaman riwayat absensi
-   [ ] Tabel riwayat muncul dengan data absensi
-   [ ] Kolom-kolom lengkap: No, Tanggal, Hari, Waktu Masuk, Waktu Keluar, Status, Durasi
-   [ ] Data absensi hari ini muncul di tabel
-   [ ] Pagination berfungsi jika data > 15
-   [ ] Tombol "Kembali" berfungsi → Redirect ke dashboard
-   [ ] Statistik ringkasan di bawah tabel muncul

---

## 🔄 Checklist Admin Melihat Absensi

-   [ ] Login sebagai admin
-   [ ] Masuk ke menu "Attendances"
-   [ ] Muncul semua data absensi (termasuk yang dibuat karyawan)
-   [ ] Data absensi karyawan yang baru tadi muncul
-   [ ] Waktu masuk dan keluar tercatat dengan benar
-   [ ] Status absensi = "Hadir"
-   [ ] Admin bisa edit data absensi jika perlu
-   [ ] Admin bisa hapus data absensi jika perlu

---

## 🔒 Checklist Security & Authorization

-   [ ] Karyawan tidak bisa akses `/admin/*` → 403 Forbidden
-   [ ] Admin tidak bisa akses `/employee/*` → 403 Forbidden
-   [ ] Guest tidak bisa akses dashboard → Redirect ke login
-   [ ] CSRF token berfungsi di form
-   [ ] Password ter-hash dengan benar di database

---

## 🎨 Checklist UI/UX

-   [ ] Responsive design (coba resize browser)
-   [ ] Warna sesuai (hijau untuk masuk, biru untuk keluar)
-   [ ] Icons muncul (Font Awesome)
-   [ ] Animations smooth (hover effects, transitions)
-   [ ] Flash messages (success/error) muncul dengan benar
-   [ ] Loading states tidak ada yang broken

---

## 🐛 Checklist Error Handling

-   [ ] Tidak ada error di console browser (F12)
-   [ ] Tidak ada error di terminal Laravel
-   [ ] Tidak ada warning di database
-   [ ] Log file bersih: `storage/logs/laravel.log`

---

## 📝 Checklist Dokumentasi

-   [ ] `README.md` sudah dibaca
-   [ ] `SETUP_MULTI_ROLE.md` sudah dibaca
-   [ ] `SUMMARY.md` sudah dibaca
-   [ ] `STRUCTURE.md` sudah dibaca (untuk pahami struktur)

---

## 🎯 Checklist Testing Lengkap

### Skenario 1: Flow Karyawan Normal

1. [ ] Login sebagai karyawan
2. [ ] Lihat dashboard
3. [ ] Klik "Absen Masuk" → Success
4. [ ] Refresh → Data tetap ada
5. [ ] Tunggu beberapa menit
6. [ ] Klik "Absen Keluar" → Success
7. [ ] Klik "Lihat Semua Riwayat" → Muncul data
8. [ ] Logout

### Skenario 2: Admin Monitoring

1. [ ] Login sebagai admin
2. [ ] Masuk ke menu "Attendances"
3. [ ] Lihat data absensi karyawan tadi
4. [ ] Coba edit data (ubah status jadi "Sakit")
5. [ ] Save → Success
6. [ ] Logout

### Skenario 3: Karyawan Lihat Perubahan

1. [ ] Login lagi sebagai karyawan
2. [ ] Lihat riwayat absensi
3. [ ] Status sudah berubah jadi "Sakit" (yang tadi diedit admin)
4. [ ] Logout

---

## ✅ Final Check

-   [ ] Semua checklist di atas sudah ✅
-   [ ] Screenshot dashboard admin tersimpan (untuk dokumentasi)
-   [ ] Screenshot dashboard karyawan tersimpan (untuk dokumentasi)
-   [ ] Aplikasi siap untuk demo/presentasi
-   [ ] Backup database dilakukan: `php artisan db:backup` (jika ada)

---

## 🎉 Selamat!

Jika semua checklist sudah ✅, maka aplikasi Anda **SUDAH SIAP DIGUNAKAN!**

### Next Steps (Opsional):

-   [ ] Deploy ke server production
-   [ ] Tambahkan fitur export Excel
-   [ ] Tambahkan sistem cuti
-   [ ] Tambahkan fitur upload foto profil
-   [ ] Buat REST API untuk mobile app

---

**Catatan:** Simpan file ini dan centang satu per satu saat melakukan setup!
