<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'NISN',
        'kelas',
        'latitude_absen',
        'longitude_absen',
        'tanggal',
        'jam',
        'guru_pembimbing',
        'foto_absen',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nama', 'nama'); // Foreign key, Local key
    }
}
