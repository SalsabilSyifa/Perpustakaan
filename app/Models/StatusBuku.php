<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusBuku extends Model
{
    public function bukus()
{
    return $this->hasMany(Buku::class);
}


}
