@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .artikel-title {
        color: #001f3f;
        font-weight: bold;
    }

    .card-custom {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 50, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0, 0, 50, 0.15);
    }

    .card-title {
        color: #001f3f;
        font-weight: 600;
    }

    .btn-navy {
        background-color: #001f3f;
        color: white;
        border: none;
    }

    .btn-navy:hover {
        background-color: #003366;
    }

    .pagination {
        justify-content: center;
    }
</style>

<div class="container">
    <h2 class="mb-4 artikel-title"><i class="bi bi-journal-text me-2"></i>Artikel Edukasi</h2>

    <div class="row">
        @foreach ($artikel as $a)
            <div class="col-md-4 mb-4">
                <div class="card card-custom h-100">
                    @if ($a->foto)
                        <img src="{{ asset('storage/' . $a->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">{{ $a->judul }}</h5>
                        <a href="{{ route('artikel.show', $a->id) }}" class="btn btn-sm btn-navy mt-3">
                            <i class="bi bi-eye-fill me-1"></i> Lihat Artikel
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $artikel->links() }} {{-- Pagination --}}
    </div>
</div>
@endsection
