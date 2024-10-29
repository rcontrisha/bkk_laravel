<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'jurusan',
        'tahun_kelulusan',
        'sasaran',
        'tempat_sasaran',
        'nomor_telepon',
        'email',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
