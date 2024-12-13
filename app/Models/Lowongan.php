<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';

    protected $fillable = [
        'judul',
        'id_mitra',
        'perusahaan',
        'lokasi',
        'kategori',
        'tipe',
        'gaji',
        'deskripsi',
        'requirement',
        'photo',
        'link_lamaran'
    ];

    public function pendaftaranLowongan()
    {
        return $this->hasMany(DaftarLowongan::class, 'lowongan_id');
    }
}
