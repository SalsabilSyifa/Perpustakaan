<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'nama',
        'alamat',
        'jeniskelamin',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'agama'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =============================
    // RELASI KE TABEL ANGGOTA
    // =============================
   protected $primaryKey = 'id_anggota';

public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}

public function peminjaman()
{
    return $this->hasMany(Peminjaman::class, 'id_anggota');
}

}
