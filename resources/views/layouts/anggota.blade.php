<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Anggota')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/anggota.css') }}">
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h5 class="logo">📚 Perpustakaan Jakarta</h5>

        <ul class="menu">
            <li><a href="#">🏠 Beranda</a></li>
            <li><a href="#">📚 Daftar Koleksi</a></li>
            <li><a href="#">⭐ Buku Favorit</a></li>
            <li><a href="#">🔄 Transaksi</a></li>
            @auth
    <li><a href="#">👤 Profil</a></li>
    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link p-0 text-decoration-none">
                🚪 Logout
            </button>
        </form>
    </li>
@else
    <li><a href="{{ route('login') }}">🔐 Login</a></li>
@endauth

        </ul>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
        @yield('content')
    </main>

</div>

</body>
</html>
