@extends('layouts.app')

@section('title', 'Dashboard Adopter')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="background-color: #f0f8ff;">
        <div class="card-body py-4">
            <h2 class="mb-3">Dashboard Adopter</h2>
            <p class="lead">Hai, <strong>{{ Auth::user()->name }}</strong>! Selamat datang di dunia adopsi hewan yang penuh kasih 🐾</p>
            <p>Di sini kamu bisa:</p>
            <ul class="mb-3">
                <li>Menjelajahi hewan-hewan yang tersedia untuk diadopsi</li>
                <li>Melihat detail informasi hewan yang kamu minati</li>
                <li>Mengajukan permintaan adopsi hewan</li>
                <li>Melihat dan memantau status dari adopsi yang telah kamu ajukan</li>
            </ul>
            <a href="{{ route('adopter.hewan.index') }}" class="btn mt-2" style="background-color: #001f3f; color: white;">Lihat Hewan Tersedia</a>

        </div>
    </div>
</div>
@endsection
