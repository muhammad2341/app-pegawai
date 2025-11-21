<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();
        
        try {
            // Ambil department dan position default (yang pertama)
            $defaultDepartment = Department::first();
            $defaultPosition = Position::first();
            
            // Validasi: harus ada minimal 1 department dan position
            if (!$defaultDepartment || !$defaultPosition) {
                throw new \Exception('Sistem belum dikonfigurasi. Hubungi administrator untuk menambahkan Department dan Position.');
            }
            
            // 1. Buat data employee terlebih dahulu
            $employee = Employee::create([
                'nama_lengkap' => $request->name,
                'email' => $request->email,
                'nomor_telepon' => '-', // Default, bisa diupdate nanti
                'tanggal_lahir' => null,
                'alamat' => '-', // Default, bisa diupdate nanti
                'tanggal_masuk' => now(),
                'department_id' => $defaultDepartment->id,
                'position_id' => $defaultPosition->id,
                'status' => 'Aktif',
            ]);

            // 2. Buat user dan kaitkan dengan employee
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'karyawan',
                'employee_id' => $employee->id, // Link ke employee yang baru dibuat
            ]);

            DB::commit();

            event(new Registered($user));

            Auth::login($user);

            // Redirect langsung ke employee dashboard
            return redirect()->route('employee.dashboard');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors([
                'email' => 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.'
            ])->withInput();
        }
    }
}
