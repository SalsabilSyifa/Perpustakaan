<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalAnggota'    => Anggota::count(),
            'totalBuku'       => Buku::count(),
        ]);
    }
}
