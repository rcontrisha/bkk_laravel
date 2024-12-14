<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama tabel bukan "mitras")
    protected $table = 'mitra';

    // Kolom yang dapat diisi
    protected $fillable = [
        'perusahaan',
        'lokasi',
        'id_user',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi dengan model User.
     * Satu mitra berhubungan dengan satu pengguna.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
