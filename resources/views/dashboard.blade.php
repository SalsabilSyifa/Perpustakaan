@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid px-4">
<div class="row g-4 mt-4">

    <div class="col-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-icon bg-primary">👤</div>
            <div>
                <h6>Total Anggota</h6>
                <h3>{{ $totalAnggota }}</h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-icon bg-success">📚</div>
            <div>
                <h6>Total Judul</h6>
                <h3>{{ $totalJudulBuku }}</h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-icon bg-info">📦</div>
            <div>
                <h6>Total Buku</h6>
                <h3>{{ $totalBuku }}</h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-4">
        <div class="stat-card bg-warning-soft">
            <div class="stat-icon bg-warning">🔄</div>
            <div>
                <h6>Buku Dipinjam</h6>
                <h3>{{ $bukuDipinjam }}</h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-4">
        <div class="stat-card bg-danger-soft">
            <div class="stat-icon bg-danger">⚠️</div>
            <div>
                <h6>Buku Rusak</h6>
                <h3>{{ $bukuRusak }}</h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-4">
        <div class="stat-card bg-dark-soft">
            <div class="stat-icon bg-dark">❌</div>
            <div>
                <h6>Buku Hilang</h6>
                <h3>{{ $bukuHilang }}</h3>
            </div>
        </div>
    </div>


    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📋 Anggota Terbaru</h5>
                <a href="{{ route('anggota.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($anggotaPreview as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_anggota }}</td>
                            <td>{{ $item->no_hp }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TABLE BUKU -->
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📚 Buku Terbaru</h5>
                <a href="{{ route('buku.index') }}" class="btn btn-sm btn-success">
                    Lihat Semua
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bukuPreview as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">🔍 Review Peminjaman Terbaru</h5>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-warning">
                Lihat Semua
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjamanPreview as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->anggota->nama_anggota }}</td>
                        <td>
                            {{ $p->bukuItem->buku->judul }} <br>
                            <small class="text-muted">
                                {{ $p->bukuItem->kode_buku }}
                            </small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}</td>
                        <td>
                            @if($p->status == 'dipinjam')
                                <span class="badge bg-warning">Dipinjam</span>
                            @elseif($p->status == 'dikembalikan')
                                <span class="badge bg-success">Dikembalikan</span>
                            @else
                                <span class="badge bg-danger">Terlambat</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Belum ada peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</div>



@endsection
