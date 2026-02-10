@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')

<div class="card">

    <!-- HEADER -->
    <div class="card-header">
        <h2>📖 Data Peminjaman</h2>

        <a href="{{ route('peminjaman.create') }}" class="btn-add">
            <span class="icon">+</span>
            Tambah Peminjaman
        </a>
    </div>

    <!-- ALERT -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"
        style="position: relative; padding-right: 40px;">
        {{ session('success') }}

        <button type="button"
            onclick="this.parentElement.remove()"
            style="
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    background: none;
                    border: none;
                    font-size: 20px;
                    cursor: pointer;
                ">
            &times;
        </button>
    </div>
    @endif

    <!-- TABLE CONTROL -->
<div class="table-control row g-3 mb-3">

    <!-- LEFT CONTROL -->
    <div class="d-flex flex-column gap-2">

        <div class="d-flex align-items-center gap-2">
            <span>Show</span>
            <select id="showEntries" class="form-select form-select-sm" style="width:80px">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
            </select>
            <span>entries</span>
        </div>

        <input type="text"
               name="search"
               form="filterForm"
               class="form-control"
               placeholder="Cari peminjam / buku / kode ..."
               value="{{ request('search') }}">
    </div>

    <!-- RIGHT CONTROL -->
    <form id="filterForm"
          method="GET"
          action="{{ route('peminjaman.index') }}"
          class="d-flex flex-column gap-2 align-items-end">

        <input type="date"
               name="from"
               class="form-control"
               value="{{ request('from') }}">

        <input type="date"
               name="to"
               class="form-control"
               value="{{ request('to') }}">

        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                🔍 Filter
            </button>

            <a href="{{ route('peminjaman.index') }}"
               class="btn btn-secondary">
                Reset
            </a>
        </div>
    </form>

</div>



    <!-- TABLE -->
    <div class="table-wrapper">
        <table id="peminjamanTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Buku</th>
                    <th>Peminjam</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        @if($p->bukuItem->buku->cover)
                        <img src="{{ asset('storage/' . $p->bukuItem->buku->cover) }}"
                            width="45"
                            style="border-radius:4px">
                        @else
                        <span class="text-muted">No Cover</span>
                        @endif
                    </td>

                    <td>
                        <strong>{{ $p->bukuItem->buku->judul }}</strong><br>
                        <small class="text-muted">{{ $p->bukuItem->kode_buku }}</small>
                    </td>

                    <td>{{ $p->anggota->nama_anggota }}</td>

                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_jatuh_tempo }}</td>
                    <td>{{ $p->tanggal_kembali ?? '-' }}</td>

                    <td>
                        @if($p->status == 'dipinjam')
                        <span class="badge bg-warning">Dipinjam</span>
                        @elseif($p->status == 'dikembalikan')
                        <span class="badge bg-success">Dikembalikan</span>
                        @else
                        <span class="badge bg-danger">Terlambat</span>
                        @endif
                    </td>

                    <td class="aksi" style="text-align:center">
                        @if($p->status == 'dipinjam')
                        <form action="{{ route('peminjaman.kembali', $p->id) }}"
                            method="POST" style="display:inline-block">
                            @csrf
                            <button class="btn btn-primary btn-sm"
                                onclick="return confirm('Yakin buku dikembalikan?')">
                                Kembalikan
                            </button>
                        </form>
                        @else
                        -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center">
                        Data peminjaman masih kosong 📭
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const showEntries = document.getElementById('showEntries');
    const table = document.getElementById('peminjamanTable');
    const rows = table.querySelectorAll('tbody tr');

    function filterTable() {
        const search = searchInput.value.toLowerCase();
        const limit = parseInt(showEntries.value);

        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(search) && visibleCount < limit) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('keyup', filterTable);
    showEntries.addEventListener('change', filterTable);
    filterTable();
</script>

@endsection