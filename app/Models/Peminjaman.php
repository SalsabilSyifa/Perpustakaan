<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = [
        'anggota_id',
        'buku_item_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_kembali',
        'status',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function bukuItem()
    {
        return $this->belongsTo(BukuItem::class);
    }
}

