@extends('layouts.app')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="container">
    <h2>✏️ Edit Rekam Medis</h2>

    <form action="{{ route('dokter.rekam-medis.update', $rekam->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $rekam->tanggal->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Diagnosa / Kondisi</label>
            <textarea name="kondisi" class="form-control" required>{{ $rekam->kondisi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Vaksinasi</label>
            <textarea name="vaksinasi" class="form-control">{{ $rekam->vaksinasi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Ganti File Hasil Pemeriksaan (opsional)</label>
            <input type="file" name="file_hasil" class="form-control">
            @if ($rekam->file_hasil)
                <p class="mt-2">📎 File Sebelumnya: 
                    <a href="{{ asset('storage/' . $rekam->file_hasil) }}" target="_blank">Lihat File</a>
                </p>
            @endif
        </div>

        <div class="mb-3">
            <label>Layak Adopsi?</label>
            <select name="layak_adopsi" class="form-control" required>
                <option value="1" {{ $rekam->layak_adopsi ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ !$rekam->layak_adopsi ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>

        <button class="btn btn-primary">Update Rekam Medis</button>
        <a href="{{ route('dokter.hewan.detail', $rekam->hewan_id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
