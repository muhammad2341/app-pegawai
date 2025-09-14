<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees'; // nama tabel

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
    ];
}
