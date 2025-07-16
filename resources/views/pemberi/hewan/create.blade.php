@extends('layouts.app')

@section('title', 'Tambah Hewan')

@section('content')
<style>
    .form-label i {
        margin-right: 6px;
        color: #007BFF;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .form-section {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    h2 {
        color: #004080;
        font-weight: bold;
    }
</style>

<div class="container">
    <h2 class="mb-4">➕ Tambah Hewan</h2>

    <div class="form-section">
        <form action="/pemberi/hewan/tambah" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-card-text"></i>Nama Hewan</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-tags"></i>Jenis Hewan</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ ucfirst($k->nama) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-patch-question"></i>Ras</label>
                <input type="text" name="ras" class="form-control @error('ras') is-invalid @enderror">
                @error('ras')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-hourglass-split"></i>Usia</label>
                <div class="input-group">
                    <input type="number" name="usia" class="form-control @error('usia') is-invalid @enderror" required>
                    <select name="usia_satuan" class="form-select @error('usia_satuan') is-invalid @enderror" required>
                        <option value="bulan">Bulan</option>
                        <option value="tahun">Tahun</option>
                    </select>
                </div>
                @error('usia')<div class="invalid-feedback">{{ $message }}</div>@enderror
                @error('usia_satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-gender-ambiguous"></i>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">-- Pilih --</option>
                    <option value="jantan">Jantan</option>
                    <option value="betina">Betina</option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-textarea-resize"></i>Deskripsi</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3"></textarea>
                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-image"></i>Foto</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" required>
                @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-check-circle"></i>Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="menunggu">Menunggu</option>
                    <option value="diverifikasi">Diverifikasi</option>
                    <option value="siap">Siap</option>
                    <option value="diadopsi">Diadopsi</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-success"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="/pemberi/hewan" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
