<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
        ->orderBy('id', 'desc')
        ->get();

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
        'nama_anggota' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    // 1️⃣ Buat akun user dulu
    $user = User::create([
        'name' => $request->nama_anggota,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'anggota'
    ]);

    // 2️⃣ Buat data anggota
    Anggota::create([
        'user_id'      => $user->id,
        'nama_anggota' => $request->nama_anggota,
        'alamat'       => $request->alamat,
        'jeniskelamin' => $request->jeniskelamin,
        'no_hp'        => $request->no_hp,
        'tempat_lahir' => $request->tempat_lahir,
        'tgl_lahir'    => $request->tgl_lahir,
        'agama'        => $request->agama,
    ]);

    return redirect()->route('anggota.index')
        ->with('success', 'Anggota & akun login berhasil dibuat');
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
