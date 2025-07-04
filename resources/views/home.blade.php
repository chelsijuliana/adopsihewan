@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="text-center mb-4">
    <h1 class="fw-bold">Selamat Datang di Sistem Adopsi Hewan 🐶🐱</h1>
    <p class="lead">Temukan hewan peliharaan yang cocok untukmu dan berikan mereka rumah baru penuh kasih!</p>
</div>

<h4 class="mb-3">Hewan Tersedia untuk Diadopsi</h4>

<div class="row">
    @forelse ($hewan as $h)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/' . $h->foto) }}" class="img-fluid" style="height: 250px; width: 100%; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title">{{ $h->nama }}</h5>
                    <p class="card-text">{{ $h->jenis }} - {{ ucfirst($h->jenis_kelamin) }}</p>
                    <a href="{{ route('adopter.hewan.show', $h->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada hewan yang tersedia saat ini.</p>
    @endforelse
</div>

@if (Auth::guest())
    <div class="mt-5 text-center">
        <h5>Belum punya akun?</h5>
        <a href="/register" class="btn btn-success">Daftar Sekarang</a>
    </div>
@endif
@endsection
