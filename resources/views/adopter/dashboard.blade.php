@extends('layouts.app')

@section('title', 'Dashboard Adopter')

@section('content')
<div class="container">
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h2 class="mb-3">🏠 Dashboard Adopter</h2>
            <p class="lead">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! 🌱</p>
            <p>Di sini kamu bisa:</p>
            <ul>
                <li>🔍 Menjelajahi hewan-hewan yang tersedia untuk diadopsi</li>
                <li>📄 Melihat detail hewan yang kamu minati</li>
                <li>❤️ Mengajukan permintaan adopsi</li>
                <li>📋 Melihat status adopsi kamu</li>
            </ul>
            <a href="{{ route('adopter.hewan.index') }}" class="btn btn-primary mt-3">Lihat Hewan Tersedia</a>
        </div>
    </div>
</div>
@endsection
