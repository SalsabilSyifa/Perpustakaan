<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\StatusBuku;
use App\Models\BukuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{

    public function index()
{
    $bukus = Buku::withCount('items')->latest()->get();
    return view('buku.index', compact('bukus'));
}


    public function create()
    {
        $kategoris = Kategori::all();
        return view('buku.create', compact('kategoris'));
    }

   public function store(Request $request)
{
    $request->validate([
        'judul'        => 'required',
        'penulis'      => 'required',
        'kategori_id'  => 'required|exists:kategoris,id',
        'tahun_terbit' => 'nullable|digits:4',
        'stock'        => 'required|integer|min:1',
        'deskripsi'    => 'nullable',
    ]);

    // ambil status tersedia
    $statusTersedia = StatusBuku::where('nama_status', 'Tersedia')->first();

    if (!$statusTersedia) {
        return back()->withErrors('Status "Tersedia" belum ada');
    }

    DB::transaction(function () use ($request, $statusTersedia) {

        // generate kode buku
        $last = Buku::latest()->first();
        $number = $last ? intval(substr($last->kode_buku, 3)) + 1 : 1;
        $kodeBuku = 'BK-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        // create buku
        $buku = Buku::create([
            'kode_buku'     => $kodeBuku,
            'judul'         => $request->judul,
            'penulis'       => $request->penulis,
            'penerbit'      => $request->penerbit,
            'tahun_terbit'  => $request->tahun_terbit,
            'kategori_id'   => $request->kategori_id,
            'deskripsi'     => $request->deskripsi,
            'stock'         => $request->stock,
            'status_buku_id'=> $statusTersedia->id,
        ]);

        // create buku_items sesuai stock
        for ($i = 1; $i <= $request->stock; $i++) {
            BukuItem::create([
                'buku_id' => $buku->id,
                'kode_buku' => $kodeBuku . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'status_buku_id' => $statusTersedia->id,
            ]);
        }
    });

    return redirect()->route('buku.index')
        ->with('success', 'Buku berhasil ditambahkan');
}




    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'judul'        => 'required',
            'penulis'      => 'required',
            'kategori_id'  => 'required|exists:kategoris,id',
            'tahun_terbit' => 'nullable|digits:4',
            'stock'        => 'required|integer|min:0',
            'deskripsi'    => 'nullable',
        ]);

        $buku->update($request->only([
            'judul',
            'penulis',
            'penerbit',
            'tahun_terbit',
            'kategori_id',
            'stock',
            'deskripsi',
        ]));

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        Buku::destroy($id);
        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
