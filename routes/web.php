<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
Route::get('/', function (Request $request) {
    $user = $request->user();
    if ($user) {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'karyawan') {
            return redirect()->route('employee.dashboard');
        }
    }
    return view('landing');
})->name('home');


Route::get('/dashboard', function (Request $request) {
    $user = $request->user(); 
    if (!$user) {
        return redirect()->route('login');
    }
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'karyawan') {
        return redirect()->route('employee.dashboard');
    }
    abort(403, 'Unauthorized access.');
})->middleware(['auth', 'verified'])->name('dashboard');


// ========================
// 🔒 ROUTE UNTUK ADMIN
// ========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('employees', App\Http\Controllers\EmployeeController::class);
    Route::resource('departments', App\Http\Controllers\DepartmentController::class);
    Route::resource('positions', App\Http\Controllers\PositionController::class);
    Route::resource('salaries', App\Http\Controllers\SalaryController::class);
    
    // Route untuk admin mengelola semua absensi
    Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
});


// ========================
// 👷 ROUTE UNTUK KARYAWAN
// ========================
Route::middleware(['auth', 'role:karyawan'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');
    // Edit profil karyawan sendiri
    Route::get('/profile', [App\Http\Controllers\Employee\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Employee\ProfileController::class, 'update'])->name('profile.update');
    
    // Route untuk absensi karyawan
    Route::post('/attendance/clock-in', [App\Http\Controllers\Employee\AttendanceController::class, 'clockIn'])->name('attendance.clockIn');
    Route::post('/attendance/clock-out', [App\Http\Controllers\Employee\AttendanceController::class, 'clockOut'])->name('attendance.clockOut');
    Route::get('/attendance/history', [App\Http\Controllers\Employee\AttendanceController::class, 'history'])->name('attendance.history');
    Route::delete('/attendance/{id}/cancel', [App\Http\Controllers\Employee\AttendanceController::class, 'cancel'])->name('attendance.cancel');
    
    // Route untuk melihat gaji sendiri
    Route::get('/salaries', [App\Http\Controllers\SalaryController::class, 'employeeIndex'])->name('salaries');
});

// ========================
// 🔐 PROFILE & AUTH
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
