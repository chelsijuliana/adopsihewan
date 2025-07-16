@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="text-center mb-5">
    <h1 class="fw-bold display-5" style="color:#001f3f;">Selamat Datang di Sistem Adopsi Hewan</h1>
    <p class="lead text-muted">Temukan hewan peliharaan yang cocok untukmu dan berikan mereka rumah baru penuh kasih!</p>
</div>

<h4 class="mb-4 fw-semibold border-bottom pb-2 text-primary">Hewan Siap Diadopsi</h4>

<div class="row">
    @forelse ($hewan as $h)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 hover-shadow transition">
                <img src="{{ asset('storage/' . $h->foto) }}" class="card-img-top rounded-top" style="height: 220px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="fw-bold" style="color: #4a70a7;">{{ $h->nama }}</h5>
                    <p class="mb-1"><i class="bi bi-tags"></i> <strong>Jenis:</strong> {{ $h->jenis }}</p>
                    <p class="mb-1"><i class="bi bi-list-ul"></i> <strong>Ras:</strong> {{ $h->ras ?? '-' }}</p>

                    @php
                        $usiaTahun = floor($h->usia / 12);
                        $usiaBulan = $h->usia % 12;
                    @endphp
                    <p class="mb-1"><i class="bi bi-hourglass"></i> <strong>Usia:</strong>
                        @if ($usiaTahun > 0)
                            {{ $usiaTahun }} tahun
                        @endif
                        @if ($usiaBulan > 0)
                            {{ $usiaBulan }} bulan
                        @endif
                    </p>

                    <p class="mb-1"><i class="bi bi-gender-ambiguous"></i> <strong>Jenis Kelamin:</strong> {{ ucfirst($h->jenis_kelamin) }}</p>

                    <p><i class="bi bi-info-circle"></i> <strong>Status:</strong> 
                        <span class="badge bg-success rounded-pill px-3">{{ ucfirst($h->status) }}</span>
                    </p>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">Belum ada hewan yang siap diadopsi saat ini.</p>
    @endforelse
</div>

<h4 class="mt-5 mb-3 fw-semibold border-bottom pb-2 text-primary">Artikel Edukasi</h4>
<div class="row">
    @forelse ($artikel as $a)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 hover-shadow transition">
                @if ($a->foto)
                    <img src="{{ asset('storage/' . $a->foto) }}" class="card-img-top rounded-top" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $a->judul }}</h5>
                    <p class="card-text text-muted">{{ Str::limit(strip_tags($a->konten), 100, '...') }}</p>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">Belum ada artikel tersedia saat ini.</p>
    @endforelse
</div>

@if (Auth::guest())
    <div class="mt-5 text-center py-4 bg-light rounded shadow-sm">
        <h5 class="fw-semibold mb-3">Belum punya akun?</h5>
        <a href="/register" class="btn btn-lg btn-success px-5 py-2 rounded-pill shadow-sm">
            <i class="bi bi-person-plus"></i> Daftar Sekarang
        </a>
    </div>
@endif
@endsection
