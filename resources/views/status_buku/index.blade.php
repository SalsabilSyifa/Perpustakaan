@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Status Buku</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th width="50">No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukus as $buku)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $buku->kode_buku }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td class="text-center">
                        @php
                        $status = optional($buku->statusBuku)->nama_status;
                        @endphp

                        <span class="badge
        @if($status == 'Tersedia') bg-success
        @elseif($status == 'Dipinjam') bg-warning
        @elseif($status == 'Rusak') bg-danger
        @elseif($status == 'Hilang') bg-dark
        @else bg-secondary
        @endif
    ">
                            {{ $status ?? 'Belum Diset' }}
                        </span>
                    </td>

                    <td class="text-center">
                        <a href="{{ route('status_buku.edit', $buku->id) }}"
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Data buku belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection