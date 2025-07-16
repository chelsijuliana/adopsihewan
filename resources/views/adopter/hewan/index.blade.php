@extends('layouts.app')

@section('title', 'Lihat Hewan Tersedia')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🐾 Hewan Siap Diadopsi</h2>

    <div class="row">
        @forelse ($hewan as $h)
        @php
            $usiaTahun = floor($h->usia / 12);
            $usiaBulan = $h->usia % 12;

            $sudahDiajukan = in_array($h->id, $hewanSudahDiajukan);

            $badgeClass = match($h->status) {
                'menunggu' => 'bg-warning text-dark',
                'diverifikasi' => 'bg-primary',
                'siap' => 'bg-success',
                'diadopsi' => 'bg-danger',
                default => 'bg-secondary'
            };
        @endphp

        <div class="col-md-4 mb-4">
            <div class="card shadow position-relative">
                <img src="{{ asset('storage/' . $h->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="fw-bold"><i class="bi bi-paw"></i> {{ $h->nama }}</h5>
                    <p><i class="bi bi-tags"></i> <strong>Jenis:</strong> {{ $h->jenis }}</p>
                    <p><i class="bi bi-shield"></i> <strong>Ras:</strong> {{ $h->ras ?? '-' }}</p>
                    <p><i class="bi bi-calendar-heart"></i> <strong>Usia:</strong>
                        @if ($usiaTahun > 0 && $usiaBulan == 0)
                            {{ $usiaTahun }} tahun
                        @elseif ($usiaTahun == 0 && $usiaBulan > 0)
                            {{ $usiaBulan }} bulan
                        @elseif ($usiaTahun > 0 && $usiaBulan > 0)
                            {{ $usiaTahun }} tahun {{ $usiaBulan }} bulan
                        @else
                            0 bulan
                        @endif
                    </p>
                    <p><i class="bi bi-gender-ambiguous"></i> <strong>Jenis Kelamin:</strong> {{ ucfirst($h->jenis_kelamin) }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($h->status) }}</span>
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('adopter.hewan.show', $h->id) }}" class="btn btn-sm" style="background-color: navy; color: white;">
                            <i class="bi bi-eye-fill"></i> Detail
                        </a>
                        <a href="{{ route('adopter.rekam-medis.lihat', $h->id) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-file-medical"></i> Rekam Medis
                        </a>

                        @if ($sudahDiajukan)
                            <button class="btn btn-secondary btn-sm" disabled>
                                <i class="bi bi-check2-circle"></i> Sudah Diajukan
                            </button>
                        @else
                            <a href="{{ route('adopter.adopsi.form', $h->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-send-plus"></i> Ajukan Adopsi
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info">Tidak ada hewan yang siap diadopsi saat ini.</div>
        @endforelse
    </div>
</div>
@endsection
