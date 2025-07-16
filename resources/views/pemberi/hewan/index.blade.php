@extends('layouts.app')

@section('title', 'Hewan Saya')

@section('content')
<style>
    .card-hewan {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease-in-out;
    }

    .card-hewan:hover {
        transform: scale(1.02);
    }

    .card-hewan h5 {
        color: #004080;
    }

    .badge-status {
        font-size: 0.85rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .card-img-top {
        object-fit: cover;
        height: 200px;
    }

    .btn-detail {
        background-color: #001f3f;
        color: white;
    }

    .btn-detail:hover {
        background-color: #003366;
        color: white;
    }

    .btn-warning, .btn-danger {
        color: white;
    }

    .badge-corner {
        padding: 8px 12px;
        font-size: 0.8rem;
        border-radius: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .icon-label {
        margin-right: 6px;
        color: #4a70a7;
    }
</style>

<div class="container">
    <h2 class="mb-4">Daftar Hewan Saya</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="/pemberi/hewan/tambah" class="btn btn-sm btn-detail mb-4">
        <i class="bi bi-plus-circle me-1"></i> Tambah Hewan
    </a>

    <div class="row">
        @foreach ($hewan as $h)
        @php
            $sudahAdopsi = $h->adoptionRequests->where('status', 'disetujui')->isNotEmpty();
            $sudahDiperiksa = $h->rekamMedis->isNotEmpty();
            $badgeClass = match($h->status) {
                'menunggu' => 'bg-warning text-dark',
                'diverifikasi' => 'bg-primary',
                'siap' => 'bg-success',
                'diadopsi' => 'bg-danger',
                default => 'bg-secondary'
            };
        @endphp

        <div class="col-md-4 mb-4">
            <div class="card card-hewan position-relative">
                {{-- Badge Diadopsi/Diperiksa --}}
                @if ($sudahAdopsi)
                    <span class="badge bg-success badge-corner position-absolute top-0 end-0 m-2">
                        <i class="bi bi-house-heart-fill me-1"></i>Diadopsi
                    </span>
                @elseif ($sudahDiperiksa)
                    <span class="badge bg-info text-dark badge-corner position-absolute top-0 end-0 m-2">
                        <i class="bi bi-check-circle-fill me-1"></i>Diperiksa
                    </span>
                @endif

                <img src="{{ asset('storage/' . $h->foto) }}" class="card-img-top" alt="Foto Hewan">

                <div class="card-body">
                    <h5 class="fw-bold">{{ $h->nama }}</h5>

                    <p><i class="bi bi-clipboard2-pulse icon-label"></i><strong>Jenis:</strong> {{ $h->jenis }}</p>
                    <p><i class="bi bi-patch-question icon-label"></i><strong>Ras:</strong> {{ $h->ras ?? '-' }}</p>

                    @php
                        $usiaTahun = floor($h->usia / 12);
                        $usiaBulan = $h->usia % 12;
                    @endphp
                    <p><i class="bi bi-calendar-heart icon-label"></i><strong>Usia:</strong>
                        {{ $usiaTahun > 0 ? $usiaTahun . ' tahun ' : '' }}
                        {{ $usiaBulan > 0 ? $usiaBulan . ' bulan' : '' }}
                        {{ $usiaTahun == 0 && $usiaBulan == 0 ? '0 bulan' : '' }}
                    </p>

                    <p><i class="bi bi-gender-ambiguous icon-label"></i><strong>Jenis Kelamin:</strong> {{ ucfirst($h->jenis_kelamin) }}</p>

                    <p><i class="bi bi-exclamation-circle icon-label"></i><strong>Status:</strong>
                        <span class="badge badge-status {{ $badgeClass }}">{{ ucfirst($h->status) }}</span>
                    </p>

                    <div class="d-flex gap-2">
                        <a href="/pemberi/hewan/detail/{{ $h->id }}" class="btn btn-sm btn-detail">
                            <i class="bi bi-eye-fill me-1"></i> Detail
                        </a>
                        <a href="/pemberi/hewan/edit/{{ $h->id }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-fill me-1"></i> Edit
                        </a>
                        <form action="/pemberi/hewan/delete/{{ $h->id }}" method="POST" onsubmit="return confirm('Hapus hewan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash-fill me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
