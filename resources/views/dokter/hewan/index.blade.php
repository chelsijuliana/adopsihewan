@extends('layouts.app')

@section('title', 'Daftar Hewan')

@section('content')
<div class="container" style="background-color: #f0f8ff; padding: 25px; border-radius: 15px;">
    <h2 class="mb-4">🐾 Daftar Hewan untuk Pemeriksaan</h2>

    @if ($hewan->isEmpty())
        <div class="alert alert-info">Tidak ada hewan yang perlu diperiksa saat ini. 🎉</div>
    @endif

    <div class="row">
        @foreach ($hewan as $h)
        <div class="col-md-4 mb-4">
            <div class="card shadow position-relative">
                <img src="{{ asset('storage/' . $h->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                {{-- Tanda sudah diperiksa --}}
                @if ($h->rekamMedis->isNotEmpty())
                    <span class="badge bg-success position-absolute top-0 end-0 m-2">✅ Sudah Diperiksa</span>
                @endif

                <div class="card-body">
                    <h5 class="fw-bold"><i class="bi bi-patch-question-fill text-primary me-1"></i>{{ $h->nama }}</h5>
                    <p><i class="bi bi-tag-fill text-secondary me-1"></i><strong>Jenis:</strong> {{ $h->jenis }}</p>
                    <p><i class="bi bi-bezier text-secondary me-1"></i><strong>Ras:</strong> {{ $h->ras ?? '-' }}</p>

                    @php
                        $usiaTahun = floor($h->usia / 12);
                        $usiaBulan = $h->usia % 12;
                    @endphp
                    <p><i class="bi bi-hourglass-split text-secondary me-1"></i><strong>Usia:</strong>
                        @if ($usiaTahun > 0)
                            {{ $usiaTahun }} tahun
                        @endif
                        @if ($usiaBulan > 0)
                            {{ $usiaBulan }} bulan
                        @endif
                    </p>

                    <p><i class="bi bi-gender-ambiguous text-secondary me-1"></i><strong>Jenis Kelamin:</strong> {{ ucfirst($h->jenis_kelamin) }}</p>

                    <p><i class="bi bi-info-circle-fill text-secondary me-1"></i><strong>Status:</strong> 
                        <span class="badge bg-{{ 
                            $h->status == 'menunggu' ? 'warning text-dark' :
                            ($h->status == 'diverifikasi' ? 'primary' :
                            ($h->status == 'siap' ? 'success' : 'danger')) }}">
                            {{ ucfirst($h->status) }}
                        </span>
                    </p>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('dokter.hewan.detail', $h->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye-fill me-1"></i>Detail
                        </a>
                        <a href="{{ route('dokter.rekam-medis.tambah', $h->id) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-clipboard-plus-fill me-1"></i>Periksa
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
