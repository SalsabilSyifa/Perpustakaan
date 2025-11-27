@extends('layouts.app')

@section('content')
<h3>Tambah Anggota</h3>

<form action="{{ route('anggota.store') }}" method="POST">
    @csrf
    <label>Nama</label>
    <input type="text" name="nama" class="form-control">

    <label>Alamat</label>
    <input type="text" name="alamat" class="form-control">

    <label>Jenis Kelamin</label>
    <input type="text" name="jenis_kelamin" class="form-control">

    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control">
    
    <label>Tempat Lahir</label>
    <input type="text" name="tempat_lahir" class="form-control">
    
    <label>Tanggal Lahir</label>
    <input type="text" name="tgl_lahir" class="form-control">
    
    <label>Agama</label>
    <input type="text" name="agama" class="form-control">

    <button class="btn btn-primary mt-2">Simpan</button>
</form>
@endsection
