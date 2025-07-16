@extends('layouts.app')

@section('title', 'Rekam Medis')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📋 Rekam Medis - {{ $hewan->nama }}</h2>

    @if ($hewan->rekamMedis->isEmpty())
        <div class="alert alert-info">Belum ada rekam medis untuk hewan ini.</div>
    @else
        @foreach ($hewan->rekamMedis as $rekam)
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    🗓️ Tanggal Pemeriksaan: {{ \Carbon\Carbon::parse($rekam->tanggal)->format('d M Y') }}
                </h5>
                <ul class="list-unstyled mb-3">
                    <li><i class="bi bi-person-vcard"></i> <strong>Dokter Pemeriksa:</strong> {{ $rekam->dokter->name ?? '-' }}</li>
                    <li><i class="bi bi-heart-pulse"></i> <strong>Kondisi / Diagnosa:</strong> <br>{{ $rekam->kondisi }}</li>
                    <li><i class="bi bi-capsule-pill"></i> <strong>Vaksinasi:</strong> <br>{{ $rekam->vaksinasi ?? '-' }}</li>
                    <li><i class="bi bi-check2-circle"></i> <strong>Layak Adopsi:</strong> 
                        <span class="badge bg-{{ $rekam->layak_adopsi ? 'success' : 'danger' }}">
                            {{ $rekam->layak_adopsi ? 'Ya' : 'Tidak' }}
                        </span>
                    </li>
                    @if ($rekam->file_hasil)
                    <li class="mt-3">
                        <i class="bi bi-file-earmark-text"></i> <strong>File Hasil:</strong><br>
                        <a href="{{ asset('storage/' . $rekam->file_hasil) }}" class="btn btn-sm btn-outline-primary mt-1" target="_blank">
                            📎 Lihat File
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        @endforeach
    @endif

    <a href="{{ route('adopter.hewan.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
@endsection
