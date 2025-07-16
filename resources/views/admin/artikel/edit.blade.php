@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .form-container {
        background-color: #f0f8ff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 50, 0.1);
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .page-title {
        color: #001f3f;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .form-label {
        color: #001f3f;
        font-weight: 500;
    }

    .form-control:focus {
        border-color: #4a70a7;
        box-shadow: 0 0 0 0.2rem rgba(74, 112, 167, 0.25);
    }

    .btn-navy {
        background-color: #001f3f;
        color: white;
        border: none;
    }

    .btn-navy:hover {
        background-color: #003366;
    }

    .btn-secondary {
        background-color: #ccc;
        color: #001f3f;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #bbb;
    }

    .current-image {
        margin-top: 10px;
    }

    .current-image img {
        border-radius: 10px;
        border: 1px solid #ccc;
    }
</style>

<div class="container col-md-8">
    <div class="form-container">
        <h2 class="page-title"><i class="bi bi-pencil-square me-2"></i>Edit Artikel</h2>

        <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="judul">Judul Artikel</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ $artikel->judul }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="konten">Konten</label>
                <textarea name="konten" id="konten" class="form-control" rows="6" required>{{ $artikel->konten }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="foto">Ganti Foto (opsional)</label>
                <input type="file" name="foto" id="foto" class="form-control">
                @if ($artikel->foto)
                    <div class="current-image">
                        <label class="form-label mt-2">Foto Saat Ini:</label><br>
                        <img src="{{ asset('storage/' . $artikel->foto) }}" alt="Foto Artikel" width="150">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Batal
                </a>
                <button class="btn btn-navy">
                    <i class="bi bi-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
