<?php
namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        // Bisa filter posisi berdasarkan department jika ada parameter department_id
        $departmentId = $request->get('department_id');
        $positions = $departmentId 
            ? Position::where('department_id', $departmentId)->paginate(10)
            : Position::paginate(10);

        $departments = Department::all();

        return view('admin.positions.index', compact('positions', 'departments', 'departmentId'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.positions.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_position' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
        ]);

        Position::create($request->all());

        return redirect()->route('admin.positions.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(Position $position)
    {
        $departments = Department::all();
        return view('admin.positions.edit', compact('position', 'departments'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'nama_position' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
        ]);

        $position->update($request->all());

        return redirect()->route('admin.positions.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        if ($position->employees()->exists()) {
            return redirect()->route('admin.positions.index')->with('error', 'Jabatan masih memiliki karyawan.');
        }

        $position->delete();
        return redirect()->route('admin.positions.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
?>