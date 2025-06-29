@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="container">
    <h2>🩺 Tambah Rekam Medis</h2>

    <form action="{{ route('dokter.rekam-medis.tambah', $hewan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Diagnosa / Kondisi</label>
            <textarea name="kondisi" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Vaksinasi</label>
            <textarea name="vaksinasi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Upload File Hasil Pemeriksaan</label>
            <input type="file" name="file_hasil" class="form-control">
        </div>
        <div class="mb-3">
            <label>Layak Adopsi?</label>
            <select name="layak_adopsi" class="form-control" required>
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>
        <button class="btn btn-success">Simpan Rekam Medis</button>
        <a href="{{ route('dokter.hewan.detail', $hewan->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
