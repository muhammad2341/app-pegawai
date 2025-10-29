<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;

class HomeController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $totalPositions = Position::count();
        $totalSalary = Salary::sum('gaji_pokok');
        $recentEmployees = Employee::latest()->take(5)->get();

        return view('home', compact(
            'totalEmployees',
            'totalDepartments',
            'totalPositions',
            'totalSalary',
            'recentEmployees'
        ));
    }
}
