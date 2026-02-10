@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>📚 Tambah Peminjaman Buku</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <!-- Anggota -->
            <div class="mb-3">
                <label class="form-label">Peminjam</label>
                <select name="anggota_id" class="form-control" required>
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($anggotas as $a)
                        <option value="{{ $a->id }}">
                            {{ $a->nama_anggota }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Buku Item -->
            <div class="mb-3">
                <label class="form-label">Buku</label>
                <select name="buku_item_id" class="form-control" required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach($bukuItems as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->buku->judul }} ({{ $item->kode_buku }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Pinjam -->
            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam"
                       class="form-control"
                       value="{{ date('Y-m-d') }}" readonly>
            </div>

            <!-- Jatuh Tempo -->
            <div class="mb-3">
                <label class="form-label">Jatuh Tempo</label>
                <input type="date" name="tanggal_jatuh_tempo"
                       class="form-control"
                       value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
            </div>

            
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                Kembali
            </a>
            <button class="btn btn-primary">
                💾 Simpan Peminjaman
            </button>
        </form>
    </div>
</div>
@endsection
