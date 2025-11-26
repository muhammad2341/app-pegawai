<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $table = 'employees'; // nama tabel

    protected $fillable = [
        'nama_lengkap', 'email', 'nomor_telepon', 'tanggal_lahir',
        'alamat', 'tanggal_masuk', 'department_id', 'position_id', 'status'
    ];
     public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }
    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class, 'karyawan_id');
    }

    // Relasi ke User (one-to-one)
    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }
}
