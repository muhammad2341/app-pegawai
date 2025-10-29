<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\HomeController;

Route::get('/', function() {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('employees', EmployeeController::class);
Route::resource('attendances', AttendanceController::class);
Route::resource('salaries', SalaryController::class);
Route::resource('departments', DepartmentController::class);

Route::get('positions', [PositionController::class, 'index'])->name('positions.index');
Route::get('positions/create', [PositionController::class, 'create'])->name('positions.create');
Route::post('positions', [PositionController::class, 'store'])->name('positions.store');
Route::get('positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
Route::put('positions/{position}', [PositionController::class, 'update'])->name('positions.update');
Route::delete('positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
Route::get('positions/{id}/employees', [\App\Http\Controllers\SalaryController::class, 'employeesByPosition']);

Route::get('/salaries/create', [SalaryController::class, 'create'])->name('salaries.create');
Route::post('/salaries/select', [SalaryController::class, 'select'])->name('salaries.select');
Route::post('/salaries/store', [SalaryController::class, 'store'])->name('salaries.store');

?>