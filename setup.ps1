# Script Setup Aplikasi Pegawai
# Jalankan dengan: .\setup.ps1

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Setup Aplikasi Manajemen Pegawai" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# 1. Install Composer Dependencies
Write-Host "[1/7] Installing Composer dependencies..." -ForegroundColor Yellow
composer install
if ($LASTEXITCODE -ne 0) {
    Write-Host "Error: Composer install failed!" -ForegroundColor Red
    exit 1
}

# 2. Install NPM Dependencies
Write-Host "[2/7] Installing NPM dependencies..." -ForegroundColor Yellow
npm install
if ($LASTEXITCODE -ne 0) {
    Write-Host "Error: NPM install failed!" -ForegroundColor Red
    exit 1
}

# 3. Copy .env file if not exists
Write-Host "[3/7] Checking .env file..." -ForegroundColor Yellow
if (-not (Test-Path .env)) {
    Copy-Item .env.example .env
    Write-Host "✓ .env file created" -ForegroundColor Green
} else {
    Write-Host "✓ .env file already exists" -ForegroundColor Green
}

# 4. Generate Application Key
Write-Host "[4/7] Generating application key..." -ForegroundColor Yellow
php artisan key:generate
if ($LASTEXITCODE -ne 0) {
    Write-Host "Error: Key generation failed!" -ForegroundColor Red
    exit 1
}

# 5. Run Migrations
Write-Host "[5/7] Running database migrations..." -ForegroundColor Yellow
Write-Host "⚠️  Pastikan database sudah dibuat dan konfigurasi .env sudah benar!" -ForegroundColor Magenta
$confirm = Read-Host "Lanjutkan migration? (y/n)"
if ($confirm -eq "y" -or $confirm -eq "Y") {
    php artisan migrate
    if ($LASTEXITCODE -ne 0) {
        Write-Host "Error: Migration failed! Periksa konfigurasi database Anda." -ForegroundColor Red
        exit 1
    }
} else {
    Write-Host "⚠️  Migration dilewati. Jalankan manual: php artisan migrate" -ForegroundColor Yellow
}

# 6. Run Seeders
Write-Host "[6/7] Running seeders..." -ForegroundColor Yellow
$confirmSeeder = Read-Host "Jalankan seeder untuk akun admin? (y/n)"
if ($confirmSeeder -eq "y" -or $confirmSeeder -eq "Y") {
    php artisan db:seed --class=AdminSeeder
    if ($LASTEXITCODE -ne 0) {
        Write-Host "Error: Seeder failed!" -ForegroundColor Red
        exit 1
    }
    Write-Host "✓ Admin seeder berhasil!" -ForegroundColor Green
}

# 7. Build Assets
Write-Host "[7/7] Building frontend assets..." -ForegroundColor Yellow
npm run build
if ($LASTEXITCODE -ne 0) {
    Write-Host "Error: Asset build failed!" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  ✓ Setup Selesai!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "Akun Login Default:" -ForegroundColor Cyan
Write-Host "  Admin:" -ForegroundColor Yellow
Write-Host "    Email: admin@example.com"
Write-Host "    Password: 123456"
Write-Host ""
Write-Host "Jalankan aplikasi dengan:" -ForegroundColor Cyan
Write-Host "  php artisan serve" -ForegroundColor Green
Write-Host ""
Write-Host "Untuk development (hot reload):" -ForegroundColor Cyan
Write-Host "  npm run dev" -ForegroundColor Green
Write-Host ""
