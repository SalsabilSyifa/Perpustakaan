<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardAnggotaController extends Controller
{

public function index()
{
    $bukus = Buku::with('kategori')->get();

    return view('anggota_view.dashboard', compact('bukus'));
}

}
