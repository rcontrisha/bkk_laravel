<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan role ke field fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function alumni()
    {
        // Cek apakah role-nya admin untuk menentukan jenis hubungan
        if ($this->role === 'admin') {
            return $this->hasMany(Alumni::class);
        }
        
        // Default hubungan untuk non-admin
        return $this->hasOne(Alumni::class);
    }

    public function pendaftaranLowongan()
    {
        return $this->hasMany(DaftarLowongan::class, 'user_id');
    }

    // Relasi dengan model Mitra
    public function mitra()
    {
        return $this->hasOne(Mitra::class, 'id_user', 'id');
    }
}
