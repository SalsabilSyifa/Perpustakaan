<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DetailBuku extends Authenticatable
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
    protected $primaryKey = 'no_buku';
public $incrementing = false;
protected $keyType = 'string';

public function buku()
{
    return $this->belongsTo(Buku::class, 'id_buku');
}

public function detailPeminjaman()
{
    return $this->hasMany(DetailPeminjaman::class, 'no_buku');
}

}
