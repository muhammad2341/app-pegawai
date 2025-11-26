<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Position;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $employee = $user->employee;
        $departments = Department::all();
        $positions = Position::all();
        return view('employee.profile-edit', compact('employee','departments','positions'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        // Update employee
        $employee->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'nomor_telepon' => $validated['nomor_telepon'] ?? null,
            'department_id' => $validated['department_id'],
            'position_id' => $validated['position_id'],
        ]);

        // Sinkronkan nama user
        $user->update(['name' => $validated['nama_lengkap']]);

        return redirect()->route('employee.profile.edit')->with('success','Profil berhasil diperbarui');
    }
}
