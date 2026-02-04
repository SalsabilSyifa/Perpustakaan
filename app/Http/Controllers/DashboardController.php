<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\BukuItem;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        
        return view('dashboard', [
            'totalAnggota'    => Anggota::count(),
            'totalJudulBuku' => Buku::count(),
            'totalBuku' => BukuItem::count(),

            'bukuDipinjam' => BukuItem::whereHas('statusBuku', function($q) {
                $q->where('nama_status', 'Dipinjam');
            })->count(),

            'bukuRusak' => BukuItem::whereHas('statusBuku', function ($q) {
                $q->where('nama_status', 'Rusak');
            })->count(),

            'bukuHilang' => BukuItem::whereHas('statusBuku', function ($q) {
                $q->where('nama_status', 'Hilang');
            })->count(),

            'anggotaPreview' => Anggota::latest()->take(5)->get(),
            'bukuPreview' => Buku::latest()->take(5)->get(),
        ]);
    }
}
