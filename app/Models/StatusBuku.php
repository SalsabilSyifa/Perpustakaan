<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusBuku extends Model
{
    protected $fillable = ['nama_status'];
    public function bukus()
{
    return $this->hasMany(Buku::class);
}

public function bukuItems()
{
    return $this->hasMany(BukuItem::class);
}

}
