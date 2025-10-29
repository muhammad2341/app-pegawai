<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'position_id',
        'bulan',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
    ];

    // Relasi ke tabel karyawan
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }

    // Relasi ke tabel posisi (jabatan)
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
