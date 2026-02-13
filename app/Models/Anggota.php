<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';
    public $incrementing = true;
    protected $keyType = 'int';
    

   protected $fillable = [
        'user_id',
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

    public function peminjamans()
{
    return $this->hasMany(Peminjaman::class);
}


public function user()
{
    return $this->belongsTo(User::class);
}

}
