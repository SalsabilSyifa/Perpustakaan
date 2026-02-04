<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuItem extends Model
{
    protected $fillable = [
        'buku_id',
        'kode_buku',
        'status_buku_id',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function statusBuku()
    {
        return $this->belongsTo(StatusBuku::class);
    }
}
