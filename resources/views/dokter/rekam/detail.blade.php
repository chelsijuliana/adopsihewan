@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container" style="background-color: #f0f8ff; padding: 25px; border-radius: 15px;">
    <h2 class="mb-4">Detail Rekam Pemeriksaan</h2>

    <div class="card shadow overflow-hidden">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ asset('storage/' . $rekam->hewan->foto) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="Foto Hewan">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">{{ $rekam->hewan->nama }}</h4>

                    <p><i class="bi bi-calendar-check me-2 text-primary"></i>
                        <strong>Tanggal Pemeriksaan:</strong> {{ \Carbon\Carbon::parse($rekam->tanggal)->format('d M Y') }}
                    </p>

                    <p><i class="bi bi-file-earmark-medical me-2 text-danger"></i>
                        <strong>Kondisi / Diagnosa:</strong><br>{{ $rekam->kondisi }}
                    </p>

                    <p><i class="bi bi-capsule"></i>
                        <strong>Vaksinasi:</strong><br>{{ $rekam->vaksinasi ?? '-' }}
                    </p>

                    <p><i class="bi bi-check-circle me-2 text-warning"></i>
                        <strong>Layak Adopsi:</strong>
                        <span class="badge bg-{{ $rekam->layak_adopsi ? 'success' : 'danger' }}">
                            {{ $rekam->layak_adopsi ? 'Ya' : 'Tidak' }}
                        </span>
                    </p>

                    @if ($rekam->file_hasil)
                        <p><i class="bi bi-paperclip me-2 text-secondary"></i>
                            <strong>File Hasil Pemeriksaan:</strong><br>
                            <a href="{{ asset('storage/' . $rekam->file_hasil) }}" class="btn btn-outline-primary btn-sm mt-1" target="_blank">
                                🔍 Lihat File
                            </a>
                        </p>
                    @endif

                    <a href="{{ route('dokter.rekam.index') }}" class="btn btn-secondary mt-4">⬅ Kembali ke Rekap</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
