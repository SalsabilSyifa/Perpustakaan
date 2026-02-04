@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Status Buku</h5>
    </div>

    <!-- CONTROL -->
    <div class="table-control">
        <div>
            Show
            <select id="showEntries">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
            </select>
            entries
        </div>

        <div>
            Search:
            <input type="text" id="searchInput" placeholder="Cari Buku...">
        </div>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Status</th>
                    <th style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukuItems as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <span class="badge badge-code">
                            {{ $item->kode_buku }}
                        </span>
                    </td>

                    <td>
                        {{ $item->buku->judul ?? '-' }}
                    </td>

                    <td class="text-center">
                        <span class="badge badge-code bg-opacity-25
            @if($item->statusBuku?->nama_status == 'Tersedia') bg-success
            @elseif($item->statusBuku?->nama_status == 'Dipinjam') bg-warning
            @elseif($item->statusBuku?->nama_status == 'Rusak') bg-danger
            @elseif($item->statusBuku?->nama_status == 'Hilang') bg-dark
            @else bg-secondary
            @endif
        ">
                            {{ $item->statusBuku->nama_status ?? 'Belum Diset' }}
                        </span>
                    </td>

                    <td class="text-center">
                        <a href="{{ route('status_buku.edit', $item->id) }}"
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada buku
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection