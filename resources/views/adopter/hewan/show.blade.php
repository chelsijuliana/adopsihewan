@extends('layouts.app')

@section('title', 'Detail Hewan')

@section('content')
<div class="container">
    <a href="{{ route('adopter.hewan.index') }}" class="btn btn-secondary mb-3">← Kembali ke daftar</a>

    <div class="card shadow">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ asset('storage/' . $hewan->foto) }}" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title">{{ $hewan->nama }} ({{ ucfirst($hewan->jenis_kelamin) }})</h3>
                    <p><strong>Jenis:</strong> {{ $hewan->jenis }}</p>
                    <p><strong>Ras:</strong> {{ $hewan->ras ?? '-' }}</p>
                    <p><strong>Usia:</strong> {{ $hewan->usia }} tahun</p>
                    <p><strong>Deskripsi:</strong><br> {{ $hewan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                    <hr>
                    <form action="#" method="POST">
                        {{-- Tombol ajukan adopsi (aktifkan nanti) --}}
                        <button class="btn btn-success" disabled>❤️ Ajukan Adopsi</button>
                        <small class="d-block text-muted mt-1">*Fitur pengajuan adopsi akan aktif selanjutnya.</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
