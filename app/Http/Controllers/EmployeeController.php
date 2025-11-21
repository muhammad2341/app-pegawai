<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Tampilkan semua employee
    public function index()
    {
        // eager loading department dan position untuk mengurangi query
        $employees = Employee::with(['department', 'position'])->latest()->paginate(5);
        return view('admin.employees.index', compact('employees'));
    }

    // Form create employee
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.employees.create', compact('departments', 'positions'));
    }

    // Simpan employee baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:50',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        Employee::create($request->all());
        return redirect()->route('admin.employees.index')->with('success', 'Employee berhasil ditambahkan.');
    }

    // Tampilkan detail employee
    public function show(string $id)
    {
        $employee = Employee::with(['department', 'position', 'attendances', 'salaries'])->findOrFail($id);
        return view('admin.employees.show', compact('employee'));
    }

    // Form edit employeeWW
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.employees.edit', compact('employee', 'departments', 'positions'));
    }

    // Update employee
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:50',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('admin.employees.index')->with('success', 'Employee berhasil diperbarui.');
    }

    // Hapus employee
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Employee berhasil dihapus.');
    }
}
