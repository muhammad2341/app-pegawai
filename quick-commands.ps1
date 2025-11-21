# Quick Commands untuk Aplikasi Pegawai

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Quick Commands - Aplikasi Pegawai" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Pilih perintah yang ingin dijalankan:" -ForegroundColor Yellow
Write-Host ""
Write-Host "[1] Jalankan Migration" -ForegroundColor Green
Write-Host "[2] Jalankan Admin Seeder" -ForegroundColor Green
Write-Host "[3] Jalankan Employee User Seeder" -ForegroundColor Green
Write-Host "[4] Refresh Database (migrate:fresh + seed)" -ForegroundColor Green
Write-Host "[5] Start Development Server" -ForegroundColor Green
Write-Host "[6] Start Dev Assets (npm run dev)" -ForegroundColor Green
Write-Host "[7] Build Production Assets" -ForegroundColor Green
Write-Host "[8] Clear Cache" -ForegroundColor Green
Write-Host "[9] Composer Dump Autoload" -ForegroundColor Green
Write-Host "[0] Exit" -ForegroundColor Red
Write-Host ""

$choice = Read-Host "Masukkan pilihan (0-9)"

switch ($choice) {
    "1" {
        Write-Host "Menjalankan migration..." -ForegroundColor Yellow
        php artisan migrate
    }
    "2" {
        Write-Host "Menjalankan Admin Seeder..." -ForegroundColor Yellow
        php artisan db:seed --class=AdminSeeder
        Write-Host ""
        Write-Host "✓ Admin berhasil dibuat!" -ForegroundColor Green
        Write-Host "  Email: admin@example.com" -ForegroundColor Cyan
        Write-Host "  Password: 123456" -ForegroundColor Cyan
    }
    "3" {
        Write-Host "Menjalankan Employee User Seeder..." -ForegroundColor Yellow
        Write-Host "⚠️  Pastikan data employees sudah ada di database!" -ForegroundColor Magenta
        $confirm = Read-Host "Lanjutkan? (y/n)"
        if ($confirm -eq "y" -or $confirm -eq "Y") {
            php artisan db:seed --class=EmployeeUserSeeder
            Write-Host ""
            Write-Host "✓ User karyawan berhasil dibuat!" -ForegroundColor Green
            Write-Host "  Password default: password123" -ForegroundColor Cyan
        }
    }
    "4" {
        Write-Host "⚠️  PERINGATAN: Ini akan menghapus semua data!" -ForegroundColor Red
        $confirm = Read-Host "Lanjutkan refresh database? (y/n)"
        if ($confirm -eq "y" -or $confirm -eq "Y") {
            php artisan migrate:fresh --seed
            Write-Host "✓ Database berhasil di-refresh!" -ForegroundColor Green
        }
    }
    "5" {
        Write-Host "Starting Laravel development server..." -ForegroundColor Yellow
        Write-Host "Aplikasi dapat diakses di: http://localhost:8000" -ForegroundColor Cyan
        php artisan serve
    }
    "6" {
        Write-Host "Starting Vite dev server..." -ForegroundColor Yellow
        npm run dev
    }
    "7" {
        Write-Host "Building production assets..." -ForegroundColor Yellow
        npm run build
        Write-Host "✓ Assets berhasil di-build!" -ForegroundColor Green
    }
    "8" {
        Write-Host "Clearing all cache..." -ForegroundColor Yellow
        php artisan cache:clear
        php artisan config:clear
        php artisan route:clear
        php artisan view:clear
        Write-Host "✓ Cache berhasil dibersihkan!" -ForegroundColor Green
    }
    "9" {
        Write-Host "Running composer dump-autoload..." -ForegroundColor Yellow
        composer dump-autoload
        Write-Host "✓ Autoload berhasil di-regenerate!" -ForegroundColor Green
    }
    "0" {
        Write-Host "Terima kasih! 👋" -ForegroundColor Cyan
        exit
    }
    default {
        Write-Host "Pilihan tidak valid!" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "Selesai!" -ForegroundColor Green
