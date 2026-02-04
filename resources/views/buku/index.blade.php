@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')

<div class="card">

    <!-- HEADER -->
    <div class="card-header">
        <h2>📚 Data Buku</h2>

        <a href="{{ route('buku.create') }}" class="btn-add">
            <span class="icon">+</span>
            Tambah Buku
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
            <input type="text" id="searchInput" placeholder="Cari buku...">
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-wrapper">
        <table id="bukuTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Stock</th>
                    <th>Deskripsi</th>
                    <th style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->judul }}</td>
                    <td>{{ $b->penulis }}</td>
                    <td>{{ $b->penerbit ?? '-' }}</td>
                    <td>{{ $b->tahun_terbit ?? '-' }}</td>
                    <td>{{ $b->stock}}</td>
                    <td>{{ $b->deskripsi }}</td>
                    <td class="aksi" style="text-align:center">
                        <a href="{{ route('buku.edit', $b->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('buku.destroy', $b->id) }}"
                            method="POST"
                            style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus buku ini?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($bukus->count() == 0)
                <tr>
                    <td colspan="7" style="text-align:center">
                        Data buku masih kosong 📭
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const showEntries = document.getElementById('showEntries');
    const table = document.getElementById('bukuTable');
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