@extends('layouts.app')

@section('title', $a->judul)

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .artikel-detail-container {
        background: #f0f8ff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 50, 0.1);
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .artikel-judul {
        color: #001f3f;
        font-weight: bold;
    }

    .artikel-tanggal {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .btn-navy {
        background-color: #001f3f;
        color: white;
        border: none;
    }

    .btn-navy:hover {
        background-color: #003366;
    }

    .artikel-konten {
        color: #333;
        font-size: 1.1rem;
        line-height: 1.7;
    }

    .artikel-img {
        border-radius: 10px;
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
        display: block;
    }
</style>

<div class="container">
    <div class="artikel-detail-container">
        <a href="{{ route('artikel.index') }}" class="btn btn-sm btn-navy mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>

        <h2 class="artikel-judul">{{ $a->judul }}</h2>
        <p class="artikel-tanggal">
            <i class="bi bi-calendar-event me-1"></i> Diposting pada {{ $a->created_at->format('d M Y') }}
        </p>

        @if ($a->foto)
            <img src="{{ asset('storage/' . $a->foto) }}" class="artikel-img">
        @endif

        <div class="artikel-konten">{!! nl2br(e($a->konten)) !!}</div>
    </div>
</div>
@endsection
