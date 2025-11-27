@extends('layouts.app')

@section('content')

<div class="main-wrapper main-wrapper-1">
<div class="main-content">
<div class="section">   
    <div class="section-header">
        <h1>Data Anggota</h1>
    </div>

    <div class="section-body">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Daftar Anggota</h4>
                <a href="{{ route('anggota.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Anggota
                </a>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-striped table-hover" id="table-anggota" style="width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th class="text-center">Aksi</th>
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
                                <td>{{ $a->tempat_lahir }}</td>
                                <td>{{ $a->tgl_lahir }}</td>
                                <td>{{ $a->agama }}</td>

                                <td class="text-center">
                                    <a href="{{ route('anggota.edit', $a->id_anggota) }}" 
                                       class="btn btn-warning btn-sm mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('anggota.destroy', $a->id_anggota) }}"
                                          method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin ingin menghapus?')"
                                                class="btn btn-danger btn-sm mx-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
</div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('#table-1').DataTable();
    });
</script>
@endpush

