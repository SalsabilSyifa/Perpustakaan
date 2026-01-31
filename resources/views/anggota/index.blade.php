@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>👥 Data Anggota</h2>
<a href="{{ route('anggota.create') }}" class="btn btn-add">
        <span class="icon">＋</span>
        <span>Tambah Anggota</span>
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
            <input type="text" id="searchInput" placeholder="Cari anggota...">
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-wrapper">
        <table class="data-table" id="anggotaTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->nama_anggota }}</td>
                    <td>{{ $a->alamat }}</td>
                    <td>{{ $a->jeniskelamin }}</td>
                    <td>{{ $a->no_hp }}</td>
                    <td class="aksi">
                        <a href="{{ route('anggota.edit', $a->id_anggota) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($anggota->count() == 0)
                <tr>
                    <td colspan="7" style="text-align:center">
                        Data anggota masih kosong 📭
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/table.js') }}"></script>
@endpush
