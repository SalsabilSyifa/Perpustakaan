@extends('layouts.app')

@section('content')

<div class="card form-card">
    <div class="card-header form-header">
        <h2>➕ Tambah Anggota</h2>
        <p>Lengkapi data anggota dengan benar</p>
    </div>

    <form action="{{ route('anggota.store') }}" method="POST" class="form-body">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_anggota" placeholder="Masukkan nama" required>
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" placeholder="Contoh: Jakarta">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir">
            </div>


            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jeniskelamin">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Agama</label>
                <select name="agama">
                    <option value="">-- Pilih --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Budha">Budha</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="3" placeholder="Alamat lengkap"></textarea>
            </div>
        </div>

        <div class="form-action">
            <a href="{{ route('anggota.index') }}" class="btn btn-back">Kembali</a>
            <button type="submit" class="btn btn-save">💾 Simpan Data</button>
        </div>
    </form>
</div>

@endsection
