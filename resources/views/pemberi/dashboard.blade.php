@extends('layouts.app')

@section('title', 'Dashboard Pemberi Hibah')

@section('content')
<div class="container">
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h2 class="mb-3">🎁 Dashboard Pemberi Hibah</h2>
            <p class="lead">Hai, <strong>{{ Auth::user()->name }}</strong>! Terima kasih telah berbagi kebaikan 💖</p>
            <p>Di sini kamu bisa:</p>
            <ul>
                <li>➕ Menambahkan hewan yang ingin dihibahkan</li>
                <li>📋 Melihat dan mengelola daftar hewan yang sudah kamu daftarkan</li>
                <li>✏️ Mengedit informasi hewan jika ada perubahan</li>
                <li>🗑️ Menghapus hewan yang tidak tersedia lagi</li>
            </ul>
            <a href="{{ route('pemberi.hewan.index') }}" class="btn btn-primary mt-3">Kelola Hewan Sekarang</a>
        </div>
    </div>
</div>
@endsection
