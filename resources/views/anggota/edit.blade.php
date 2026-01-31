@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')

<div class="card form-card">
    <h2>✏️ Edit Anggota</h2>

    <form action="{{ route('anggota.update', $anggota->id_anggota) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama_anggota"
                   value="{{ $anggota->nama_anggota }}">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat"
                   value="{{ $anggota->alamat }}">
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jeniskelamin">
                <option value="Laki-laki"
                    {{ $anggota->jeniskelamin == 'Laki-laki' ? 'selected' : '' }}>
                    Laki-laki
                </option>
                <option value="Perempuan"
                    {{ $anggota->jeniskelamin == 'Perempuan' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp"
                   value="{{ $anggota->no_hp }}">
        </div>

        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir"
                   value="{{ $anggota->tempat_lahir }}">
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir"
                   value="{{ $anggota->tgl_lahir }}">
        </div>

        <div class="form-group">
    <label>Agama</label>
    <select name="agama" required>
        <option value="">-- Pilih Agama --</option>

        <option value="Islam"
            {{ $anggota->agama == 'Islam' ? 'selected' : '' }}>
            Islam
        </option>

        <option value="Kristen"
            {{ $anggota->agama == 'Kristen' ? 'selected' : '' }}>
            Kristen
        </option>

        <option value="Katolik"
            {{ $anggota->agama == 'Katolik' ? 'selected' : '' }}>
            Katolik
        </option>

        <option value="Hindu"
            {{ $anggota->agama == 'Hindu' ? 'selected' : '' }}>
            Hindu
        </option>

        <option value="Budha"
            {{ $anggota->agama == 'Budha' ? 'selected' : '' }}>
            Budha
        </option>

        <option value="Konghucu"
            {{ $anggota->agama == 'Konghucu' ? 'selected' : '' }}>
            Konghucu
        </option>
    </select>
</div>
        <div class="form-action">
            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
                ⬅ Kembali
            </a>

            <button class="btn btn-primary">
                💾 Update
            </button>
        </div>
    </form>
</div>

@endsection
