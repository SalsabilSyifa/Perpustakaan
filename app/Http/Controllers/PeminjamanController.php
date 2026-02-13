<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\BukuItem;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
public function index(Request $request)
{
    $search = $request->search;
    $from   = $request->from;
    $to     = $request->to;

    $peminjamans = Peminjaman::with(['anggota', 'bukuItem.buku'])

        // 🔍 SEARCH (FIX)
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('anggota', function ($a) use ($search) {
                    $a->where('nama_anggota', 'like', "%$search%");
                })
                ->orWhereHas('bukuItem.buku', function ($b) use ($search) {
                    $b->where('judul', 'like', "%$search%");
                })
                ->orWhereHas('bukuItem', function ($i) use ($search) {
                    $i->where('kode_buku', 'like', "%$search%");
                });
            });
        })

        // 📅 FILTER TANGGAL
        ->when($from && $to, function ($query) use ($from, $to) {
            $query->whereBetween('tanggal_pinjam', [$from, $to]);
        })

        ->latest()
        ->get();

    return view('peminjaman.index', compact('peminjamans'));
}



public function laporan()
{
    $peminjamans = Peminjaman::with([
        'anggota',
        'bukuItem.buku'
    ])->orderBy('tanggal_pinjam', 'desc')->get();

    return view('laporan.peminjaman', compact('peminjamans'));
}


public function store(Request $request)
{
    $request->validate([
        'anggota_id' => 'required|exists:anggotas,id',
        'buku_item_id' => 'required|exists:buku_items,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_jatuh_tempo' => 'required|date',
    ]);

        $bukuTersedia = BukuItem::where('id', $request->buku_item_id)
        ->where('status_buku_id', 1)
        ->first();

    if (!$bukuTersedia) {
        return redirect()
            ->back()
            ->with('error', 'Buku sedang dipinjam / stok habis');
    }
    
    DB::transaction(function () use ($request) {
        $today = Carbon::today();
        $jatuhTempo = $today->copy()->addDays(7);

        Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'buku_item_id' => $request->buku_item_id,
            'tanggal_pinjam' => $today,
            'tanggal_jatuh_tempo' => $jatuhTempo,
            'status' => 'dipinjam',
        ]);

        BukuItem::where('id', $request->buku_item_id)
            ->update(['status_buku_id' => 2]); // 2 = dipinjam

    });
            return redirect()
        ->route('peminjaman.index')
        ->with('success', 'Peminjaman berhasil ditambahkan');
}

public function create()
{
    $anggotas = Anggota::all();
    $bukuItems = BukuItem::whereHas('statusBuku', function ($q) {
        $q->where('nama_status', 'Tersedia');
    })->with('buku')->get();

    return view('peminjaman.create', compact('anggotas', 'bukuItems'));
}

public function returnBook($id)
{
    DB::transaction(function () use ($id) {

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'tanggal_kembali' => now(),
            'status' => now()->gt($peminjaman->tanggal_jatuh_tempo)
                ? 'terlambat'
                : 'dikembalikan'
        ]);

        BukuItem::where('id', $peminjaman->buku_item_id)
            ->update(['status_buku_id' => 1]); // tersedia
    });

    return redirect()
        ->route('peminjaman.index')
        ->with('success', 'Buku berhasil dikembalikan');
}

public function exportExcel()
{
    return "Export Excel belum dibuat 😄";
}

}
