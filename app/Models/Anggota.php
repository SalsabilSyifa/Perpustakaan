<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable
{
    use HasFactory, Notifiable;

protected $table = 'anggotas';
protected $primaryKey = 'id_anggota';
public $incrementing = true;
    protected $keyType = 'int';
    

   protected $fillable = [
        'nama_anggota',
        'alamat',
        'jeniskelamin',
        'no_hp',
        'tempat_lahir',
        'tgl_lahir',
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

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
