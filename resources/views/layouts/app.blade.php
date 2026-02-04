<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="app">

<!-- OVERLAY -->
    <div class="overlay" id="overlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="logo">Library</div>

        <ul class="menu">
                   <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('anggota.index') }}"
           class="{{ request()->routeIs('anggota.*') ? 'active' : '' }}">
            👥 Anggota
        </a>

        <a href="{{ route('buku.index') }}"
           class="{{ request()->routeIs('buku.*') ? 'active' : '' }}">
            📚 Buku
        </a>

         <a href="{{ route('status_buku.index') }}">
        📘 Status Buku
    </a>

        <a href=""
           class="">
            🔄 Peminjaman
        </a>
        </ul>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <header class="topbar">
            <!-- HAMBURGER -->
            <button id="hamburger" class="hamburger">☰</button>

        </header> 

        <main class="content">
            @yield('content')
        </main>
    </div>

</div>


<script>
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const menuLinks = document.querySelectorAll('.menu a');

    function openSidebar() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
    }

    function closeSidebar() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    }

    hamburger.textContent = sidebar.classList.contains('active') ? '✕' : '☰';

    hamburger.addEventListener('click', () => {
        sidebar.classList.contains('active') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    menuLinks.forEach(link => {
        link.addEventListener('click', closeSidebar);
    });
</script>
</body>
</html>
