# 🔐 Penjelasan Sistem Middleware - Proteksi Akses Multi-Role

## 📚 Apa itu Middleware?

**Middleware** adalah lapisan filter yang berada **di tengah** antara request user dan aplikasi. Middleware memeriksa dan memvalidasi request sebelum mencapai controller atau route handler.

```
User Request → Middleware (Filter) → Controller → Response
```

---

## 🎯 Sistem Middleware di Aplikasi Ini

Aplikasi ini menggunakan **2 jenis middleware** untuk proteksi:

### 1️⃣ **Auth Middleware** (Built-in Laravel)

-   Mengecek apakah user sudah **login** atau belum
-   Jika belum login → Redirect ke halaman login

### 2️⃣ **Role Middleware** (Custom)

-   Mengecek apakah user punya **role/peran** yang sesuai
-   Jika role tidak sesuai → Error 403 (Forbidden)

---

## 🏗️ Struktur Middleware di Aplikasi

```
bootstrap/app.php
│
└─── Registrasi Middleware Alias
     'role' => RoleMiddleware::class

app/Http/Middleware/RoleMiddleware.php
│
└─── Logic pengecekan role user

routes/web.php
│
├─── Route dengan middleware(['auth', 'role:admin'])
└─── Route dengan middleware(['auth', 'role:karyawan'])
```

---

## 📋 Detail Setiap Komponen

### 1. **bootstrap/app.php** - Registrasi Middleware

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ]);
})
```

**Penjelasan:**

-   Mendaftarkan alias `'role'` untuk `RoleMiddleware`
-   Setelah didaftarkan, bisa digunakan di routes dengan nama `'role'`
-   Tanpa registrasi ini, middleware tidak bisa dipakai

---

### 2. **app/Http/Middleware/RoleMiddleware.php** - Logic Middleware

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles  (bisa multiple roles)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah role user ada di dalam array $roles yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            // Jika tidak sesuai → Tampilkan error 403
            abort(403, 'Unauthorized access.');
        }

        // Jika sesuai → Lanjutkan ke controller
        return $next($request);
    }
}
```

**Penjelasan:**

-   `handle()` = method yang dijalankan middleware
-   `$request` = HTTP request dari user
-   `$next` = fungsi untuk lanjut ke tahap berikutnya
-   `...$roles` = parameter role yang diizinkan (bisa lebih dari 1)
-   `$request->user()->role` = role dari user yang sedang login
-   `in_array()` = cek apakah role user ada di daftar role yang diizinkan
-   `abort(403)` = hentikan request dengan error 403 Forbidden

---

### 3. **routes/web.php** - Penerapan Middleware

#### Route untuk **ADMIN** (dengan 2 middleware):

```php
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::resource('employees', EmployeeController::class);
        Route::resource('departments', DepartmentController::class);
        // ... route admin lainnya
    });
```

**Penjelasan:**

-   `middleware(['auth', 'role:admin'])` = Gabungan 2 middleware
    -   `'auth'` = User HARUS login dulu
    -   `'role:admin'` = User HARUS punya role 'admin'
-   `prefix('admin')` = Semua route punya prefix `/admin`
-   Semua route di dalam group ini **dilindungi** middleware

#### Route untuk **KARYAWAN**:

```php
Route::middleware(['auth', 'role:karyawan'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {
        Route::get('/dashboard', [EmployeeDashboardController::class, 'index']);
        Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn']);
        // ... route karyawan lainnya
    });
```

**Penjelasan:**

-   `'role:karyawan'` = Hanya user dengan role 'karyawan' yang boleh akses
-   Admin **TIDAK BISA** akses route ini (akan error 403)

---

## 🔄 Alur Kerja Middleware (Flow Diagram)

### Skenario 1: Admin mencoba akses `/admin/employees`

```
┌─────────────────────────────────────────────────────────┐
│ 1. User akses: /admin/employees                         │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│ 2. Middleware 'auth' dijalankan                          │
│    Cek: Apakah user sudah login?                        │
└────────────────────┬────────────────────────────────────┘
                     │
         ┌───────────┴───────────┐
         │                       │
         ▼                       ▼
    ┌─────────┐            ┌──────────┐
    │  BELUM  │            │  SUDAH   │
    │  LOGIN  │            │  LOGIN   │
    └────┬────┘            └────┬─────┘
         │                      │
         ▼                      ▼
┌──────────────────┐   ┌─────────────────────────────────┐
│ Redirect ke      │   │ 3. Middleware 'role:admin'      │
│ halaman login    │   │    Cek: $request->user()->role  │
└──────────────────┘   └────────────┬────────────────────┘
                                    │
                        ┌───────────┴──────────┐
                        │                      │
                        ▼                      ▼
                   ┌─────────┐          ┌──────────┐
                   │  role   │          │  role    │
                   │  !=     │          │  ==      │
                   │ 'admin' │          │ 'admin'  │
                   └────┬────┘          └────┬─────┘
                        │                    │
                        ▼                    ▼
                ┌──────────────┐    ┌──────────────────┐
                │ abort(403)   │    │ LANJUT ke        │
                │ "Unauthorized│    │ Controller       │
                │  access"     │    │ EmployeeController│
                └──────────────┘    └────────┬─────────┘
                                             │
                                             ▼
                                    ┌──────────────────┐
                                    │ Return response  │
                                    │ (halaman list    │
                                    │  employees)      │
                                    └──────────────────┘
```

### Skenario 2: Karyawan mencoba akses `/admin/employees` (DITOLAK!)

```
┌─────────────────────────────────────────────────────────┐
│ 1. Karyawan akses: /admin/employees                     │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│ 2. Middleware 'auth' → ✅ PASS (sudah login)            │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│ 3. Middleware 'role:admin'                               │
│    Cek: $request->user()->role == 'karyawan'            │
│    Diizinkan: hanya 'admin'                             │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
            ┌────────────────┐
            │  TIDAK MATCH!  │
            │  karyawan !=   │
            │    admin       │
            └───────┬────────┘
                    │
                    ▼
        ┌─────────────────────────┐
        │ abort(403, 'Unauthorized│
        │        access.')        │
        └───────────┬─────────────┘
                    │
                    ▼
        ┌─────────────────────────┐
        │  TAMPIL ERROR PAGE:     │
        │  "403 Forbidden"        │
        │  "Unauthorized access." │
        └─────────────────────────┘
```

### Skenario 3: Guest (belum login) mencoba akses `/admin/employees`

```
┌─────────────────────────────────────────────────────────┐
│ 1. Guest akses: /admin/employees                        │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│ 2. Middleware 'auth'                                     │
│    Cek: $request->user() == null                        │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
            ┌────────────────┐
            │  BELUM LOGIN!  │
            └───────┬────────┘
                    │
                    ▼
        ┌─────────────────────────┐
        │ REDIRECT ke             │
        │ /login                  │
        │ (dengan intended URL)   │
        └───────────┬─────────────┘
                    │
                    ▼
        ┌─────────────────────────┐
        │ Tampil halaman login    │
        │                         │
        │ Setelah login → redirect│
        │ ke /admin/employees     │
        └─────────────────────────┘
```

---

## 🔍 Kode Detail dengan Penjelasan

### Middleware 'auth' (Built-in Laravel)

```php
// Di routes/web.php
Route::middleware(['auth'])->group(function () {
    // Route yang perlu login
});
```

**Yang dilakukan:**

1. Cek apakah `$request->user()` ada (user login)
2. Jika tidak → Redirect ke `/login`
3. Jika ya → Lanjut ke middleware berikutnya

### Middleware 'role' (Custom)

```php
// Di RoleMiddleware.php
public function handle(Request $request, Closure $next, ...$roles): Response
{
    // $roles = ['admin'] (dari 'role:admin')
    // $request->user()->role = 'karyawan' (contoh)

    if (!in_array($request->user()->role, $roles)) {
        // 'karyawan' tidak ada di ['admin']
        // Maka abort dengan error 403
        abort(403, 'Unauthorized access.');
    }

    return $next($request);
}
```

**Yang dilakukan:**

1. Ambil role user dari database: `$request->user()->role`
2. Bandingkan dengan role yang diizinkan: `$roles`
3. Jika tidak cocok → Error 403
4. Jika cocok → Lanjut ke controller

---

## 🎨 Penerapan di Route

### Format Middleware di Route:

```php
Route::middleware(['middleware1', 'middleware2:param'])
    ->group(function () {
        // Routes
    });
```

**Contoh Real:**

```php
// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Semua route di sini:
    // 1. User HARUS sudah login
    // 2. Role user HARUS 'admin'
});

// Karyawan routes
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    // Semua route di sini:
    // 1. User HARUS sudah login
    // 2. Role user HARUS 'karyawan'
});

// Profile routes (semua user yang login)
Route::middleware(['auth'])->group(function () {
    // Semua user yang login bisa akses
    // Tidak peduli rolenya apa
});
```

---

## 🛡️ Keamanan Berlapis (Layered Security)

Aplikasi ini menggunakan **2 lapis keamanan**:

```
┌────────────────────────────────────────────┐
│  LAPIS 1: Auth Middleware                  │
│  ┌──────────────────────────────────────┐  │
│  │ Cek: Apakah user sudah login?        │  │
│  │ Jika TIDAK → Redirect ke /login     │  │
│  │ Jika YA → Lanjut ke lapis 2          │  │
│  └──────────────────────────────────────┘  │
└────────────────────────────────────────────┘
                    │
                    ▼
┌────────────────────────────────────────────┐
│  LAPIS 2: Role Middleware                  │
│  ┌──────────────────────────────────────┐  │
│  │ Cek: Apakah role user sesuai?        │  │
│  │ Jika TIDAK → Error 403               │  │
│  │ Jika YA → Lanjut ke Controller       │  │
│  └──────────────────────────────────────┘  │
└────────────────────────────────────────────┘
                    │
                    ▼
            ┌──────────────┐
            │  CONTROLLER  │
            │  (Aman!)     │
            └──────────────┘
```

---

## 💡 Keuntungan Sistem Middleware

### ✅ **Keamanan Terjamin**

-   Guest tidak bisa akses halaman yang perlu login
-   Karyawan tidak bisa akses halaman admin
-   Admin tidak bisa akses halaman karyawan

### ✅ **Kode Bersih & Reusable**

-   Logic pengecekan role tidak perlu ditulis berulang
-   Cukup tambahkan middleware di route

### ✅ **Mudah Maintenance**

-   Jika ingin ubah logic role, cukup edit 1 file (RoleMiddleware.php)
-   Semua route langsung terpengaruh

### ✅ **Flexible**

-   Bisa tambahkan multiple roles: `'role:admin,manager'`
-   Bisa kombinasikan berbagai middleware

---

## 🧪 Testing Middleware

### Test 1: Guest akses admin page

```
URL: http://localhost:8000/admin/dashboard
Expected: Redirect ke /login
```

### Test 2: Karyawan akses admin page

```
Login sebagai: karyawan@example.com
URL: http://localhost:8000/admin/dashboard
Expected: Error 403 Forbidden
```

### Test 3: Admin akses admin page

```
Login sebagai: admin@example.com
URL: http://localhost:8000/admin/dashboard
Expected: Berhasil tampil dashboard
```

### Test 4: Admin akses employee page

```
Login sebagai: admin@example.com
URL: http://localhost:8000/employee/dashboard
Expected: Error 403 Forbidden
```

### Test 5: Karyawan akses employee page

```
Login sebagai: karyawan@example.com
URL: http://localhost:8000/employee/dashboard
Expected: Berhasil tampil dashboard
```

---

## 📊 Tabel Akses Berdasarkan Role

| URL                             | Guest      | Karyawan | Admin    |
| ------------------------------- | ---------- | -------- | -------- |
| `/`                             | ✅         | ✅       | ✅       |
| `/login`                        | ✅         | ✅       | ✅       |
| `/admin/dashboard`              | ❌ → Login | ❌ → 403 | ✅       |
| `/admin/employees`              | ❌ → Login | ❌ → 403 | ✅       |
| `/admin/attendances`            | ❌ → Login | ❌ → 403 | ✅       |
| `/employee/dashboard`           | ❌ → Login | ✅       | ❌ → 403 |
| `/employee/attendance/clock-in` | ❌ → Login | ✅       | ❌ → 403 |
| `/profile`                      | ❌ → Login | ✅       | ✅       |

**Keterangan:**

-   ✅ = Bisa akses
-   ❌ → Login = Redirect ke halaman login
-   ❌ → 403 = Error 403 Forbidden

---

## 🔧 Cara Menambahkan Role Baru

Jika ingin tambahkan role baru (misalnya `'manager'`):

### 1. Tambahkan di database

```sql
ALTER TABLE users MODIFY role ENUM('admin', 'karyawan', 'manager');
```

### 2. Buat route group untuk manager

```php
Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {
        Route::get('/dashboard', [ManagerDashboardController::class, 'index']);
        // ... route manager lainnya
    });
```

### 3. Middleware otomatis bekerja!

RoleMiddleware tidak perlu diubah, sudah mendukung multiple roles.

---

## 🎯 Kesimpulan

### Sistem Middleware di Aplikasi Ini:

1. **Auth Middleware** → Pastikan user sudah login
2. **Role Middleware** → Pastikan user punya role yang sesuai
3. **Gabungan keduanya** → Keamanan berlapis yang kuat

### Cara Kerja:

```
Request → Auth Check → Role Check → Controller → Response
```

### Proteksi yang Diberikan:

-   ✅ Guest tidak bisa akses route yang perlu login
-   ✅ User dengan role salah tidak bisa akses route yang bukan untuknya
-   ✅ Setiap route terlindungi secara otomatis
-   ✅ Error handling yang jelas (403 Forbidden)

---

**Dengan sistem middleware ini, aplikasi Anda AMAN dari akses tidak sah!** 🔐
