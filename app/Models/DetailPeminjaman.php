<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DetailPeminjaman extends Authenticatable
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
   protected $primaryKey = 'id_detail';

public function peminjaman()
{
    return $this->belongsTo(Peminjaman::class, 'id_pinjam');
}

public function buku()
{
    return $this->belongsTo(DetailBuku::class, 'no_buku', 'no_buku');
}

}
