@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')

<div class="card form-card">
    <h2>✏️ Edit Buku</h2>

    <form action="{{ route('buku.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul"
                   value="{{ old('judul', $buku->judul) }}"
                   required>
        </div>

        {{-- Penulis --}}
        <div class="form-group">
            <label>Penulis</label>
            <input type="text" name="penulis"
                   value="{{ old('penulis', $buku->penulis) }}"
                   required>
        </div>

        {{-- Penerbit --}}
        <div class="form-group">
            <label>Penerbit</label>
            <input type="text" name="penerbit"
                   value="{{ old('penerbit', $buku->penerbit) }}">
        </div>

        {{-- Tahun Terbit --}}
        <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit"
                   value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                   maxlength="4">
        </div>

        {{-- Kategori --}}
        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>

                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ $buku->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- stock --}}
        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock"
                   value="{{ old('stock', $buku->stock) }}"
                   maxlength="4">
        </div>
        {{-- Deskripsi --}}
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
        </div>

        {{-- Action --}}
        <div class="form-action">
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                ⬅ Kembali
            </a>

            <button type="submit" class="btn btn-primary">
                💾 Update
            </button>
        </div>
    </form>
</div>

@endsection
