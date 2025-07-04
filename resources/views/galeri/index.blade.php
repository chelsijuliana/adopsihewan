@extends('layouts.app')

@section('title', 'Galeri Adopsi')

@section('content')
<div class="container">
    <h2>🐾 Galeri Adopsi Berhasil</h2>
    <p class="text-muted">Berikut adalah hewan-hewan yang telah menemukan rumah baru.</p>

    <div class="row">
        @forelse ($adopsi as $a)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/' . $a->hewan->foto) }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $a->hewan->nama }}</h5>
                    <p class="card-text"><strong>Jenis:</strong> {{ $a->hewan->jenis }}<br>
                        <strong>Adopter:</strong> {{ $a->adopter->nama }}
                    </p>
                    <span class="badge bg-success">Adopsi Disetujui</span>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Belum ada data adopsi disetujui.</p>
        @endforelse
    </div>
</div>
@endsection
