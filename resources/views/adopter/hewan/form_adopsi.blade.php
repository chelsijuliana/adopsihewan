@extends('layouts.app')

@section('title', 'Ajukan Adopsi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📝 Formulir Pengajuan Adopsi</h2>

    <div class="card shadow border-0 p-4">
        <form action="{{ route('adopter.adopsi', $hewan->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="alasan" class="form-label fw-semibold">
                    <i class="bi bi-chat-text-fill me-1 text-primary"></i> Alasan Adopsi
                </label>
                <textarea name="alasan" id="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="4" required placeholder="Ceritakan mengapa kamu ingin mengadopsi hewan ini..."></textarea>
                @error('alasan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pengalaman" class="form-label fw-semibold">
                    <i class="bi bi-paw-fill me-1 text-success"></i> Pengalaman Merawat Hewan
                </label>
                <textarea name="pengalaman" id="pengalaman" class="form-control @error('pengalaman') is-invalid @enderror" rows="3" required placeholder="Ceritakan pengalamanmu dalam merawat hewan..."></textarea>
                @error('pengalaman')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('adopter.hewan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send-check"></i> Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
