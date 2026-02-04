<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'deskripsi',
        'stock',
        'status_buku_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    
    public function statusBuku()
{
    return $this->belongsTo(StatusBuku::class, 'status_buku_id');
}

public function items()
{
    return $this->hasMany(BukuItem::class);
}


}
