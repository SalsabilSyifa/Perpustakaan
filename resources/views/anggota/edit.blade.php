@extends('layouts.app')

@section('content')
<h3>Edit Anggota</h3>

<form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama</label>
    <input type="text" name="nama" value="{{ $anggota->nama }}" class="form-control">

    <label>Alamat</label>
    <input type="text" name="alamat" value="{{ $anggota->alamat }}" class="form-control">

    <label>Jenis Kelamin</label>
    <input type="text" name="jenis_kelamin" value="{{ $anggota->jenis_kelamin }}" class="form-control">

    <label>No HP</label>
    <input type="text" name="no_hp" value="{{ $anggota->no_hp }}" class="form-control">
  
    <label>Tempat Lahir</label>
    <input type="text" name="tempat_lahir" value="{{ $anggota->tempat_lahir }}" class="form-control">
    
    <label>Tanggal Lahir</label>
    <input type="text" name="tgl_lahir" value="{{ $anggota->tgl_lahir }}" class="form-control">
    
    <label>Agama</label>
    <input type="text" name="agama" value="{{ $anggota->agama }}" class="form-control">
    
    <button class="btn btn-primary mt-2">Update</button>
</form>
@endsection
