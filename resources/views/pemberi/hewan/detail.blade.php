@extends('layouts.app')

@section('title', 'Detail Hewan Saya')

@section('content')
<style>
    .info-icon {
        color: #0d6efd;
        margin-right: 6px;
    }

    .card-detail {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: none;
        border-radius: 15px;
    }

    .card-detail img {
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
        object-fit: cover;
        height: 100%;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<div class="container">
    <h2 class="mb-4">Detail Hewan</h2>

    <div class="card card-detail mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $hewan->foto) }}" class="img-fluid h-100 w-100" alt="Foto {{ $hewan->nama }}">
            </div>
            <div class="col-md-8">
                <div class="card-body py-4 px-4">
                    <h3 class="card-title fw-bold mb-3">
                        <i class="bi bi-patch-question info-icon"></i>{{ $hewan->nama }}
                    </h3>

                    <p><i class="bi bi-tags info-icon"></i><strong>Jenis:</strong> {{ $hewan->jenis }}</p>
                    <p><i class="bi bi-bookmark-star info-icon"></i><strong>Ras:</strong> {{ $hewan->ras ?? '-' }}</p>

                    @php
                        $usiaTahun = floor($hewan->usia / 12);
                        $usiaBulan = $hewan->usia % 12;
                    @endphp
                    <p><i class="bi bi-hourglass-split info-icon"></i><strong>Usia:</strong>
                        @if ($usiaTahun > 0)
                            {{ $usiaTahun }} tahun
                        @endif
                        @if ($usiaBulan > 0)
                            {{ $usiaBulan }} bulan
                        @endif
                        @if ($usiaTahun === 0 && $usiaBulan === 0)
                            0 bulan
                        @endif
                    </p>

                    <p><i class="bi bi-gender-ambiguous info-icon"></i><strong>Jenis Kelamin:</strong> {{ ucfirst($hewan->jenis_kelamin) }}</p>
                    <p><i class="bi bi-info-circle info-icon"></i><strong>Deskripsi:</strong><br>{{ $hewan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    <p><i class="bi bi-check-circle info-icon"></i><strong>Status:</strong> {{ ucfirst($hewan->status) }}</p>

                    <a href="/pemberi/hewan" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
