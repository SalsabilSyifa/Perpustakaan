<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\StatusBuku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->latest()->get();
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
            'deskripsi'    => 'nullable',
        ]);

        // generate kode buku otomatis
        $last = Buku::latest()->first();
        $number = $last ? intval(substr($last->kode_buku, 3)) + 1 : 1;
        $kodeBuku = 'BK-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        $statusTersedia = StatusBuku::where('nama_status', 'Tersedia')->first();
        Buku::create([
            'kode_buku'    => $kodeBuku,
            'judul'        => $request->judul,
            'penulis'      => $request->penulis,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori_id'  => $request->kategori_id,
            'deskripsi'    => $request->deskripsi,
            'stock'        => 0,
            'status_buku-id'=> $statusTersedia?->id,
        ]);

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
            'deskripsi'    => 'nullable',
        ]);

        $buku->update($request->only([
            'judul',
            'penulis',
            'penerbit',
            'tahun_terbit',
            'kategori_id',
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
