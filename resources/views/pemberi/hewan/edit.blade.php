@extends('layouts.app')

@section('title', 'Edit Hewan')

@section('content')
<style>
    .form-icon-label {
        font-weight: bold;
    }

    .form-icon-label i {
        margin-right: 6px;
        color: #0d6efd;
    }

    .preview-img {
        border-radius: 8px;
        object-fit: cover;
        height: 150px;
        width: 150px;
        border: 1px solid #ddd;
        box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0069d9;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<div class="container">
    <h2 class="mb-4">Edit Hewan</h2>

    @php
        $usiaVal = old('usia', $hewan->usia);
        $usiaSatuan = 'bulan';
        if ($usiaVal % 12 == 0) {
            $usiaVal = $usiaVal / 12;
            $usiaSatuan = 'tahun';
        }
    @endphp

    <form action="/pemberi/hewan/update/{{ $hewan->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-icon-label"><i class="bi bi-patch-question"></i>Nama Hewan</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $hewan->nama) }}" required>
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-icon-label"><i class="bi bi-tags"></i>Jenis Hewan</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}" {{ $hewan->category_id == $k->id ? 'selected' : '' }}>
                        {{ ucfirst($k->nama) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-icon-label"><i class="bi bi-bookmark-star"></i>Ras</label>
            <input type="text" name="ras" class="form-control @error('ras') is-invalid @enderror" value="{{ old('ras', $hewan->ras) }}">
            @error('ras') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-icon-label"><i class="bi bi-hourglass-split"></i>Usia</label>
            <div class="input-group">
                <input type="number" name="usia" class="form-control @error('usia') is-invalid @enderror" value="{{ $usiaVal }}" required>
                <select name="usia_satuan" class="form-select @error('usia_satuan') is-invalid @enderror" required>
                    <option value="bulan" {{ $usiaSatuan == 'bulan' ? 'selected' : '' }}>Bulan</option>
                    <option value="tahun" {{ $usiaSatuan == 'tahun' ? 'selected' : '' }}>Tahun</option>
                </select>
            </div>
            @error('usia') <div class="invalid-feedback">{{ $message }}</div> @enderror
            @error('usia_satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-icon-label"><i class="bi bi-gender-ambiguous"></i>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                <option value="">-- Pilih --</option>
                <option value="jantan" {{ old('jenis_kelamin', $hewan->jenis_kelamin) == 'jantan' ? 'selected' : '' }}>Jantan</option>
                <option value="betina" {{ old('jenis_kelamin', $hewan->jenis_kelamin) == 'betina' ? 'selected' : '' }}>Betina</option>
            </select>
            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-icon-label"><i class="bi bi-info-circle"></i>Deskripsi</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $hewan->deskripsi) }}</textarea>
            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-icon-label"><i class="bi bi-image"></i>Ganti Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror

            <p class="mt-2"><strong>Foto Saat Ini:</strong><br>
                <img src="{{ asset('storage/' . $hewan->foto) }}" class="preview-img mt-2">
            </p>
        </div>

        <div class="mb-3">
            <label class="form-icon-label"><i class="bi bi-toggle-on"></i>Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="menunggu" {{ old('status', $hewan->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diverifikasi" {{ old('status', $hewan->status) == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                <option value="siap" {{ old('status', $hewan->status) == 'siap' ? 'selected' : '' }}>Siap</option>
                <option value="diadopsi" {{ old('status', $hewan->status) == 'diadopsi' ? 'selected' : '' }}>Diadopsi</option>
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Update</button>
            <a href="/pemberi/hewan" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
        </div>
    </form>
</div>
@endsection
