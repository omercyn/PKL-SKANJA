<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPresensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lokasi',
        'alamat_lokasi',
        'guru_pembimbing',
        'latitude',
        'longitude',
        'radius',
        'zona_waktu',
        'jam_masuk',
    ];
}
