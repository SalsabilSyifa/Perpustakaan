@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')

<div class="container">
    <h3>Edit Role User</h3>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('users.update', $user->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $user->name }}"
                           disabled>
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="admin"
                            {{ $user->role == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="petugas"
                            {{ $user->role == 'petugas' ? 'selected' : '' }}>
                            Petugas
                        </option>
                        <option value="anggota"
                            {{ $user->role == 'anggota' ? 'selected' : '' }}>
                            Anggota
                        </option>
                    </select>
                </div>

                <button class="btn btn-primary">
                    Update
                </button>

            </form>

        </div>
    </div>
</div>

@endsection
