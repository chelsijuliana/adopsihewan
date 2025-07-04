<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Adopsi Hewan - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @php
        $role = Auth::user()->role ?? null;
        $bg = match($role) {
            'admin' => 'bg-danger',
            'dokter' => 'bg-success',
            'adopter' => 'bg-primary',
            'pemberi' => 'bg-warning',
            default => 'bg-dark',
        };
    @endphp

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark {{ $bg }} px-4">
        <a class="navbar-brand" href="#">🐾 Adopsi Hewan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a href="/" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="/register" class="nav-link">Daftar</a></li>
                    <li class="nav-item"><a href="{{ route('artikel.index') }}" class="nav-link">Artikel</a></li>

                    
                @endguest

                @auth
                    @if ($role === 'admin')
                        <li class="nav-item"><a href="/admin/dashboard" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="/admin/users" class="nav-link">Kelola Pengguna</a></li>
                        <li class="nav-item"><a href="/admin/laporan" class="nav-link">Laporan</a></li>
                        <li class="nav-item"><a href="/admin/hewan" class="nav-link">Data Hewan</a></li>
                        <li class="nav-item"><a href="/admin/adopsi" class="nav-link">Permintaan Adopsi</a></li>
                        <li class="nav-item"><a href="/admin/medis" class="nav-link">Rekam Medis</a></li>
                        <li class="nav-item"><a href="/admin/artikel" class="nav-link">Kelola Artikel</a></li>


                    @elseif ($role === 'dokter')
                        <li class="nav-item"><a href="/dokter/dashboard" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="/dokter/pemeriksaan" class="nav-link">Pemeriksaan Hewan</a></li>
                        <li class="nav-item"><a href="/dokter/hewan" class="nav-link">Data Hewan</a></li>


                    @elseif ($role === 'adopter')
                        <li class="nav-item"><a href="/adopter/dashboard" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="/adopter/hewan" class="nav-link">Lihat Hewan</a></li>
                        <li class="nav-item"><a href="{{ route('adopter.status') }}" class="nav-link">📋 Status Adopsi</a></li>


                    @elseif ($role === 'pemberi')
                        <li class="nav-item"><a href="/pemberi/dashboard" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="/pemberi/hewan" class="nav-link">Hewan Saya</a></li>
                        <li class="nav-item"><a href="/pemberi/tambah" class="nav-link">Tambah Hewan</a></li>
                    @endif

                    <li class="nav-item"><a href="/logout" class="nav-link text-light">Logout</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    {{-- Konten Halaman --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center py-4 text-muted">
        &copy; {{ date('Y') }} Sistem Adopsi Hewan by Chelsi 💖
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
