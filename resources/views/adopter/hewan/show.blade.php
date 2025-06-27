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

                    {{-- Pesan sukses/gagal --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- Form ajukan adopsi --}}
                    <form action="{{ route('adopter.adopsi', $hewan->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>📝 Alasan ingin mengadopsi <span class="text-danger">*</span></label>
                            <textarea name="alasan" class="form-control" rows="3" required>{{ old('alasan') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>💡 Pengalaman merawat hewan (opsional)</label>
                            <textarea name="pengalaman" class="form-control" rows="3">{{ old('pengalaman') }}</textarea>
                        </div>
                        <button class="btn btn-success">❤️ Ajukan Adopsi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
