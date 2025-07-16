@extends('layouts.app')

@section('title', 'Rekap Pemeriksaan')

@section('content')
<div class="container" style="background-color: #f0f8ff; padding: 25px; border-radius: 15px;">
    <h2 class="mb-4">Rekap Pemeriksaan Saya</h2>

    @if ($rekam->isEmpty())
        <div class="alert alert-info">Belum ada hewan yang kamu periksa.</div>
    @endif

    <div class="row">
        @foreach ($rekam as $r)
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <img src="{{ asset('storage/' . $r->hewan->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Foto {{ $r->hewan->nama }}">

                <div class="card-body">
                    <h5 class="fw-bold">{{ $r->hewan->nama }}</h5>
                    <p><i class="bi bi-tag-fill me-1 text-secondary"></i><strong>Jenis:</strong> {{ $r->hewan->jenis }}</p>
                    <p><i class="bi bi-bezier me-1 text-secondary"></i><strong>Ras:</strong> {{ $r->hewan->ras ?? '-' }}</p>
                    
                    @php
                        $usiaTahun = floor($r->hewan->usia / 12);
                        $usiaBulan = $r->hewan->usia % 12;
                    @endphp
                    <p><i class="bi bi-hourglass-split me-1 text-secondary"></i><strong>Usia:</strong>
                        @if ($usiaTahun > 0)
                            {{ $usiaTahun }} tahun
                        @endif
                        @if ($usiaBulan > 0)
                            {{ $usiaBulan }} bulan
                        @endif
                    </p>

                    <p><i class="bi bi-gender-ambiguous me-1 text-secondary"></i><strong>Jenis Kelamin:</strong> {{ ucfirst($r->hewan->jenis_kelamin) }}</p>
                    <p><i class="bi bi-calendar-event me-1 text-secondary"></i><strong>Tanggal Pemeriksaan:</strong> {{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</p>

                    <a href="{{ route('dokter.rekam.detail', $r->id) }}" class="btn btn-outline-primary btn-sm w-100 mt-2">
                        <i class="bi bi-file-earmark-text me-1"></i> Lihat Rekap Pemeriksaan
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
