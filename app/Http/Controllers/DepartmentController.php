<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::latest()->paginate(10);
        return view('departments.index', compact('departments'));
    }

  
    public function create(): View
    {
        return view('departments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'department_name' => 'required|string|max:100|unique:departments,department_name',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function show(Department $department): View
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department): View
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department): RedirectResponse
    {
        $request->validate([
            'department_name' => 'required|string|max:100|unique:departments,department_name,' . $department->id,
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        if ($department->employees()->exists()) {
            return redirect()->route('departments.index')
                             ->with('error', 'Departemen tidak dapat dihapus karena masih memiliki karyawan.');
        }

        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil dihapus.');
    }
}