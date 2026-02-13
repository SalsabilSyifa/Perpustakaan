<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $appends = ['denda'];

    protected $table = 'peminjamans';
    protected $fillable = [
        'anggota_id',
        'buku_item_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_kembali',
        'status',
    ];


public function getDendaAttribute()
{
    $batasPinjam = 7;
    $tarifDenda  = 10000;

    $jatuhTempo = Carbon::parse($this->tanggal_pinjam)->addDays($batasPinjam);
    $today = Carbon::now();

    if ($today->gt($jatuhTempo) && $this->status != 'dikembalikan') {
        return $jatuhTempo->diffInDays($today) * $tarifDenda;
    }

    return 0;
}

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function bukuItem()
    {
        return $this->belongsTo(BukuItem::class);
    }
}

