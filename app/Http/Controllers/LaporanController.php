<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Exports\PeminjamanExport;
use App\Models\Peminjaman;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

public function index()
{
    $batasPinjam = 7; // hari
    $tarifDenda  = 1000;

    $today = Carbon::now();

    $peminjamans = Peminjaman::with(['anggota', 'bukuItem.buku'])->get();

    foreach ($peminjamans as $p) {
        $jatuhTempo = Carbon::parse($p->tanggal_pinjam)->addDays($batasPinjam);

        if ($today->gt($jatuhTempo) && $p->status != 'dikembalikan') {
            $hariTelat = $jatuhTempo->diffInDays($today);
            $p->denda = $hariTelat * $tarifDenda;
        } else {
            $p->denda = 0;
        }
    }

    return view('laporan.peminjaman', compact('peminjamans'));
}


    public function exportExcel()
    {
        return Excel::download(
            new PeminjamanExport,
            'laporan-peminjaman.xlsx'
        );
    }
}
