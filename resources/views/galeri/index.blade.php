@extends('layouts.app')

@section('title', 'Galeri Adopsi')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .galeri-title {
        color: #001f3f;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 30px;
    }

    .card-galeri {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 50, 0.1);
        transition: all 0.3s ease;
    }

    .card-galeri:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0, 0, 50, 0.15);
    }

    .card-galeri .card-title {
        color: #4a70a7; /* warna nama hewan */
        font-size: 1.2rem;
        font-weight: bold;
    }

    .card-galeri .card-text {
        font-size: 0.95rem;
        color: #333;
    }

    .text-muted {
        text-align: center;
        margin-top: 40px;
        font-size: 1.1rem;
    }
</style>

<div class="container">
    <h2 class="galeri-title"><i class="bi bi-images me-2"></i>Galeri Adopsi</h2>

    <div class="row">
        @forelse ($galeri as $g)
            <div class="col-md-4 mb-4">
                <div class="card card-galeri h-100">
                    <img src="{{ asset('storage/' . $g->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $g->hewan->nama }}</h5>
                        <p class="card-text mb-1"><strong>Jenis:</strong> {{ $g->hewan->jenis }}</p>
                        <p class="card-text mb-1"><strong>Adopter:</strong> {{ $g->adopter->name }}</p>
                        <p class="card-text mt-2">{{ $g->deskripsi }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada adopsi yang ditampilkan.</p>
        @endforelse
    </div>
</div>
@endsection
