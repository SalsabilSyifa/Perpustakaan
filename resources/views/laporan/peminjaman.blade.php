@extends('layouts.app')

@section('content')
<div class="card">
    <h4 class="mb-3">Laporan Peminjaman Buku</h4>
    <a href="{{ route('laporan.peminjaman.excel') }}"
   class="btn btn-success mb-3">
   📊 Export Excel
</a>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>ID Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $no => $p)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $p->anggota->nama_anggota ?? '-' }}</td>
                    <td>{{ $p->bukuItem->buku->judul ?? '-' }}</td>
                    <td>{{ $p->bukuItem->kode_buku ?? $p->bukuItem->id }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_jatuh_tempo }}</td>
                    <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $p->status == 'dipinjam' ? 'warning' : 
                            ($p->status == 'terlambat' ? 'danger' : 'success') 
                        }}">
                            {{ ucfirst($p->status) }}

                            
                        </span>
                    </td>
                    <td>
    @if($p->denda > 0)
        <span class="text-danger fw-bold">
            Rp {{ number_format($p->denda, 0, ',', '.') }}
        </span>
    @else
        -
    @endif
</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
