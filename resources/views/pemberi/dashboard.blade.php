@extends('layouts.app')

@section('title', 'Dashboard Pemberi Hibah')

@section('content')
<!-- Styling tambahan -->
<style>
    .dashboard-card {
        background-color: #f9fcff;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .dashboard-card h2 {
        color: #004080;
        font-weight: 700;
    }

    .dashboard-card p.lead {
        color: #333;
        font-size: 1.1rem;
    }

    .dashboard-card ul {
        list-style: none;
        padding-left: 0;
    }

    .dashboard-card ul li {
        margin-bottom: 10px;
        padding-left: 1.6em;
        position: relative;
        color: #444;
    }

    .dashboard-card ul li::before {
        content: "🐾";
        position: absolute;
        left: 0;
    }

    .btn-kelola {
        background-color: #004080;
        border: none;
    }

    .btn-kelola:hover {
        background-color: #003060;
    }
</style>

<div class="container">
    <div class="card dashboard-card mt-4 p-4">
        <div class="card-body">
            <h2 class="mb-3">Dashboard Pemberi Hibah</h2>
            <p class="lead">Hai, <strong>{{ Auth::user()->name }}</strong>! Terima kasih telah berbagi kebaikan</p>
            <p>Di sini kamu bisa:</p>
            <ul>
                <li>Menambahkan hewan yang ingin dihibahkan</li>
                <li>Melihat dan mengelola daftar hewan yang sudah kamu daftarkan</li>
                <li>Mengedit informasi hewan jika ada perubahan</li>
                <li>Menghapus hewan yang tidak tersedia lagi</li>
            </ul>
            <a href="{{ route('pemberi.hewan.index') }}" class="btn btn-kelola text-white mt-3">
                <i class="bi bi-list-check me-1"></i> Kelola Hewan Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
