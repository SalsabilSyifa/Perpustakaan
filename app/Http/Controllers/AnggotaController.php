<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // ======================
    // TAMPIL DATA
    // ======================
public function index(Request $request)
{
    $search = $request->search;

    $anggota = Anggota::when($search, function ($query) use ($search) {
            $query->where('nama_anggota', 'like', "%$search%")
                  ->orWhere('no_hp', 'like', "%$search%");
        })
        ->orderBy('id_anggota', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view('anggota.index', compact('anggota', 'search'));
}

    // ======================
    // FORM TAMBAH
    // ======================
    public function create()
    {
        return view('anggota.create');
    }

    // ======================
    // SIMPAN DATA
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'nama_anggota'  => 'required',
            'alamat'        => 'required',
            'jeniskelamin'  => 'required',
            'no_hp'         => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required|date',
            'agama'         => 'required',
        ]);

        Anggota::create([
            'nama_anggota' => $request->nama_anggota,
            'alamat'       => $request->alamat,
            'jeniskelamin' => $request->jeniskelamin,
            'no_hp'        => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir'    => $request->tgl_lahir,
            'agama'        => $request->agama,
        ]);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    // ======================
    // FORM EDIT
    // ======================
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    // ======================
    // UPDATE DATA
    // ======================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_anggota'  => 'required',
            'alamat'        => 'required',
            'jeniskelamin'  => 'required',
            'no_hp'         => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required|date',
            'agama'         => 'required',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->all());

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil diupdate');
    }

    // ======================
    // HAPUS DATA
    // ======================
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus');
    }
}
