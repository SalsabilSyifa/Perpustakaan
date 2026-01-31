@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h2>📘 Tambah Buku</h2>
        <p>Isi data buku dengan lengkap</p>
    </div>

    <form action="{{ route('buku.store') }}" method="POST">
        @csrf

        <div class="form-body">
            <div class="form-grid">

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" placeholder="Judul buku" required>
                </div>

                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="penulis" placeholder="Nama penulis" required>
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" placeholder="Nama penerbit">
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="year" name="tahun_terbit" placeholder="2024">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $k)
                        <option value="{{ $k->id }}">
                            {{ $k->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Stok Buku</label>
                    <input type="number" name="stock" min="0" value="0" required>
                </div>

                <div class="form-group full">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        placeholder="Deskripsi singkat buku"></textarea>
                </div>

            </div>

            <div class="form-action">
                <a href="{{ route('buku.index') }}" class="btn-back">⬅ Kembali</a>
                <button type="submit" class="btn-save">💾 Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection