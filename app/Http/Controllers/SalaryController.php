<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class SalaryController extends Controller
{
    public function index(): View
    {
        $salaries = Salary::with(['employee.position'])->latest()->paginate(10);
        return view('admin.salaries.index', compact('salaries'));
    }

    public function create(Request $request): View
    {
        $positions = Position::orderBy('nama_jabatan')->get();
        $selectedPositionId = $request->input('position_id');
        $selectedEmployeeId = $request->input('karyawan_id');

        // filter employee berdasarkan position (jika dipilih)
        $employees = $selectedPositionId
            ? Employee::where('position_id', $selectedPositionId)->get()
            : Employee::all();

        // ambil jabatan otomatis jika employee dipilih
        if ($selectedEmployeeId) {
            $employee = Employee::with('position')->find($selectedEmployeeId);
            if ($employee) {
                $selectedPositionId = $employee->position_id;
            }
        }

        return view('admin.salaries.create', compact('positions', 'employees', 'selectedPositionId', 'selectedEmployeeId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'position_id' => 'required|exists:positions,id',
            'bulan' => 'required|string|max:7',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $employee = Employee::with('position')->findOrFail($request->karyawan_id);
        $gajiPokok = $employee->position->gaji_pokok;

        $data = [
            'karyawan_id' => $employee->id,
            'position_id' => $employee->position_id,
            'bulan' => $request->bulan . '-01',
            'gaji_pokok' => $gajiPokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan' => $request->potongan ?? 0,
            'total_gaji' => $gajiPokok + ($request->tunjangan ?? 0) - ($request->potongan ?? 0),
        ];

        Salary::create($data);

        return redirect()->route('admin.salaries.index')->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function edit(Salary $salary, Request $request): View
    {
        $positions = Position::orderBy('nama_jabatan')->get();
        $selectedPositionId = $request->input('position_id', $salary->position_id);
        $selectedEmployeeId = $request->input('karyawan_id', $salary->karyawan_id);

        $employees = $selectedPositionId
            ? Employee::where('position_id', $selectedPositionId)->get()
            : Employee::all();

        $salary->bulan = substr($salary->bulan, 0, 7);
        return view('admin.salaries.edit', compact('salary', 'positions', 'employees', 'selectedPositionId', 'selectedEmployeeId'));
    }

    public function update(Request $request, Salary $salary): RedirectResponse
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'position_id' => 'required|exists:positions,id',
            'bulan' => 'required|string|max:7',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $employee = Employee::with('position')->findOrFail($request->karyawan_id);
        $gajiPokok = $employee->position->gaji_pokok;

        $data = [
            'karyawan_id' => $employee->id,
            'position_id' => $employee->position_id,
            'bulan' => $request->bulan . '-01',
            'gaji_pokok' => $gajiPokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan' => $request->potongan ?? 0,
            'total_gaji' => $gajiPokok + ($request->tunjangan ?? 0) - ($request->potongan ?? 0),
        ];

        $salary->update($data);

        return redirect()->route('admin.salaries.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy(Salary $salary): RedirectResponse
    {
        $salary->delete();
        return redirect()->route('admin.salaries.index')->with('success', 'Data gaji berhasil dihapus.');
    }
}
