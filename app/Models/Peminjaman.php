<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Peminjaman extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
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
    protected $primaryKey = 'id_pinjam';

public function anggota()
{
    return $this->belongsTo(Anggota::class, 'id_anggota');
}

public function detail()
{
    return $this->hasMany(DetailPeminjaman::class, 'id_pinjam');
}

}
