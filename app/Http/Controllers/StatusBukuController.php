<?php

namespace App\Http\Controllers;
use App\Models\StatusBuku;
use App\Models\Buku;
use App\Models\BukuItem;
use Illuminate\Http\Request;

class StatusBukuController extends Controller
{
    public function index()
{

    $bukuItems = BukuItem::with(['buku', 'statusBuku'])
            ->orderBy('id', 'desc')
            ->get();

            return view('status_buku.index', compact('bukuItems'));
}

    public function create()
    {
        return view('status_buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_status' => 'required'
        ]);

        StatusBuku::create($request->all());

        return redirect()->route('status-buku.index')
            ->with('success', 'Status buku berhasil ditambahkan');
    }

    public function edit($id)
{
    $item = BukuItem::with('buku')->findOrFail($id);
    $statuses = StatusBuku::all();

    return view('status_buku.edit', compact('item', 'statuses'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'status_buku_id' => 'required|exists:status_bukus,id'
    ]);

    $item = BukuItem::findOrFail($id);
    $item->update([
        'status_buku_id' => $request->status_buku_id
    ]);

    return redirect()->route('status_buku.index')
        ->with('success', 'Status buku berhasil diperbarui');
}


    public function destroy(StatusBuku $statusBuku)
    {
        $statusBuku->delete();

        return redirect()->route('status-buku.index')
            ->with('success', 'Status buku berhasil dihapus');
    }
}
