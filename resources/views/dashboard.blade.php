@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>
<p>Selamat datang di Sistem Informasi Perpustakaan 📚</p>
 
<div class="dashboard">

    <div class="card stat">
        <h3>Total Anggota</h3>
        <p>{{ $totalAnggota }}</p>
    </div>

    <div class="card stat">
        <h3>Total Buku</h3>
        <p>{{ $totalBuku }}</p>
    </div>

    <div class="card stat">
        <h3>Peminjaman Aktif</h3>
        <p></p>
    </div>

</div>

@endsection
