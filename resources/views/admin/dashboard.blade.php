@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .dashboard-container {
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .dashboard-title {
        color: #001f3f;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .card-dashboard {
        border-radius: 15px;
        background: #f0f8ff;
        box-shadow: 0 4px 12px rgba(0, 0, 50, 0.1);
        padding: 25px;
        border: none;
    }

    .card-dashboard p,
    .card-dashboard ul {
        font-size: 1.05rem;
        color: #333;
    }

    .card-dashboard ul li {
        margin-bottom: 10px;
    }

    .highlight-name {
        color: #4a70a7;
        font-weight: 600;
    }
</style>

<div class="container dashboard-container">
    <h2 class="dashboard-title"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</h2>

    <div class="card card-dashboard">
        <p>Halo, <span class="highlight-name">{{ auth()->user()->name }}</span>! 👋</p>
        <p>Selamat datang di halaman dashboard Admin. Di sini Anda memiliki akses untuk:</p>
        <ul>
            <li><i class="bi bi-people-fill me-1 text-primary"></i> Mengelola data pengguna (user) yang terdaftar dalam sistem.</li>
            <li><i class="bi bi-journal-text me-1 text-primary"></i> Mengelola dan menerbitkan artikel edukasi untuk pengunjung website.</li>
            <li><i class="bi bi-paw-fill me-1 text-primary"></i> Melihat daftar hewan yang telah didaftarkan oleh para pemberi hibah.</li>
            <li><i class="bi bi-stethoscope me-1 text-primary"></i> Melihat daftar hewan yang telah diperiksa oleh dokter hewan.</li>
            <li><i class="bi bi-clipboard-check-fill me-1 text-primary"></i> Melihat semua pengajuan adopsi dari para adopter.</li>
        </ul>
        <p>Gunakan navigasi di atas untuk mengakses fitur-fitur tersebut.</p>
    </div>
</div>
@endsection
