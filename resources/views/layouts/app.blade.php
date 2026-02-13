<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
        }
        .nav-link.active {
            background-color: #0d6efd;
            color: white !important;
            border-radius: 5px;
        }
    </style>
</head>
<body>


<div class="app">

<!-- OVERLAY -->


    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="logo">📚Library</div>

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

        <a href="{{ route('peminjaman.index') }}"
           class=" request()->routeIs('peminjaman.*') ? 'active' : '' }}">
            🔄 Peminjaman
        </a>

        <a href="{{ route('users.index') }}"
           class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            👤 Users
        </a>

    <a href="{{ route('laporan.peminjaman') }}" 
        class="nav-link  {{ request()->routeIs('laporan.peminjaman') ? 'active' : '' }}">
        📄 Laporan Peminjaman
    </a>

                <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100">
                    🚪 Logout
                </button>
            </form>
        </ul>
                    <!-- LOGOUT DI PALING BAWAH -->

    </aside>
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>
    <!-- MAIN -->
    <div class="main">
        <header class="topbar">
            <!-- HAMBURGER -->
<button class="btn btn-outline-primary d-md-none"
        id="hamburger">
    ☰
</button>

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
    hamburger.textContent = '✕';
}

function closeSidebar() {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
    hamburger.textContent = '☰';
}

hamburger.addEventListener('click', () => {
    sidebar.classList.contains('active') 
        ? closeSidebar() 
        : openSidebar();
});

overlay.addEventListener('click', closeSidebar);

menuLinks.forEach(link => {
    link.addEventListener('click', closeSidebar);
    
    function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
    document.querySelector('.overlay').classList.toggle('active');
}
});

</script>



</body>
</html>
