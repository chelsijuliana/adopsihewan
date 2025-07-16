@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="container" style="background-color: #f0f8ff; padding: 30px; border-radius: 15px;">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="mb-3">Dashboard Dokter Hewan</h2>
            <p class="lead">Selamat datang, <strong>Dokter</strong>!</p>
            <p>Silakan cek dan kelola rekam medis hewan yang terdaftar di sistem.</p>

            <a href="{{ route('dokter.hewan.index') }}" class="btn mt-3" style="background-color: #001f3f; color: white;">
                Lihat Daftar Hewan
            </a>
        </div>
    </div>
</div>
@endsection
