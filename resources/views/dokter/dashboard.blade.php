@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="container">
    <h2 class="mb-3">🩺 Dashboard Dokter Hewan</h2>
    <p>Selamat datang, Dokter. Silakan cek dan kelola rekam medis hewan yang terdaftar di sistem.</p>
    <a href="{{ route('dokter.hewan.index') }}" class="btn btn-primary mt-3">Lihat Daftar Hewan</a>
</div>
@endsection
