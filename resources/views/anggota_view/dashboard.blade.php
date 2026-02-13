@extends('layouts.anggota')

@section('title', 'Dashboard Anggota')

@section('content')

<h4 class="mb-1">Rekomendasi Buku</h4>
<p class="text-muted mb-4">Temukan inspirasi baca kamu!</p>

<!-- FILTER -->
<div class="mb-3">
    <button class="btn btn-sm btn-primary">Direkomendasikan</button>
    <button class="btn btn-sm btn-outline-secondary">Ensiklopedia</button>
    <button class="btn btn-sm btn-outline-secondary">Agama</button>
    <button class="btn btn-sm btn-outline-secondary">Ekonomi</button>
</div>

<!-- GRID BUKU -->
<div class="row g-3">
@if(isset($bukus))
    @foreach($bukus as $buku)
    <div class="col-6 col-md-3">
        <div class="card h-100">
            <img src="{{ $buku->cover ?? asset('img/default-book.png') }}" class="card-img-top">
            <div class="card-body">
                <small class="text-muted">
                    {{ $buku->kategori->nama ?? '-' }}
                </small>
                <h6 class="mt-1">{{ $buku->judul }}</h6>
                <small>{{ $buku->penulis }}</small>
            </div>
        </div>
    </div>
    @endforeach
@endif
</div>


@endsection
