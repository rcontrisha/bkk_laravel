<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarLowongan extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_lowongan'; 

    protected $fillable = [
        'user_id',
        'lowongan_id',
        'status', // Contoh: "pending", "accepted", "rejected"
        'lokasi_interview',
        'tanggal_interview'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }
}
