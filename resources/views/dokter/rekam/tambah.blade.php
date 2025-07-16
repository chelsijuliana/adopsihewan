@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="container">
    <h2 class="mb-4">🩺 Tambah Rekam Medis untuk <strong>{{ $hewan->nama }}</strong></h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form action="{{ route('dokter.rekam-medis.tambah', $hewan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-calendar3 me-2"></i>Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-clipboard-pulse me-2"></i>Diagnosa / Kondisi</label>
                <textarea name="kondisi" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-capsule-pill me-2"></i>Vaksinasi</label>
                <textarea name="vaksinasi" class="form-control" rows="2" placeholder="Contoh: Vaksin rabies, parvo, dll..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-upload me-2"></i>File Hasil Pemeriksaan <span class="text-muted">(opsional)</span></label>
                <input type="file" name="file_hasil" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                <div class="form-text">Format yang diperbolehkan: PDF, JPG, JPEG, PNG. Maksimal 2MB.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-check2-circle me-2"></i>Layak Adopsi?</label>
                <select name="layak_adopsi" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success"><i class="bi bi-save me-1"></i> Simpan Rekam Medis</button>
                <a href="{{ route('dokter.hewan.detail', $hewan->id) }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
