@extends('layouts.app')

@section('title', 'Hewan Tersedia')

@section('content')
<div class="container">
    <h2 class="mb-4">🐾 Hewan Tersedia untuk Diadopsi</h2>

    <div class="row">
        @forelse ($hewan as $h)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $h->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $h->nama }} ({{ $h->jenis_kelamin }})</h5>
                        <p class="card-text">{{ $h->jenis }} - {{ $h->ras }}</p>
                        <p class="text-muted">Usia: {{ $h->usia }} tahun</p>
                        <a href="{{ route('adopter.hewan.show', $h->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>

                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada hewan yang tersedia saat ini.</p>
        @endforelse
    </div>
</div>
@endsection
