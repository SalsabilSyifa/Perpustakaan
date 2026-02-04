@extends('layouts.app')

@section('content')
<div class="card form-card">
    <h2>Edit Status Buku</h2>

    <form action="{{ route('status_buku.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" class="form-control"
                   value="{{ $item->buku->judul }}"
                   readonly>
        </div>

        <div class="form-group">
            <label>Status Buku</label>
            <select name="status_buku_id" class="form-select" required>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}"
                        {{ $item->status_buku_id == $status->id ? 'selected' : '' }}>
                        {{ $status->nama_status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-action">
            <a href="{{ route('status_buku.index') }}" class="btn btn-secondary">
                Kembali
            </a>
            <button class="btn btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
