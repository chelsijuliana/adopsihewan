@extends('layouts.app')

@section('title', 'Tambah Artikel')

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

    .alert-danger {
        border-radius: 10px;
        background-color: #ffe5e5;
        color: #c0392b;
    }
</style>

<div class="container col-md-8">
    <div class="form-container">
        <h2 class="page-title"><i class="bi bi-journal-plus me-2"></i>Tambah Artikel</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Artikel</label>
                <input type="text" name="judul" id="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="konten" class="form-label">Konten</label>
                <textarea name="konten" id="konten" class="form-control" rows="6" required></textarea>
            </div>

            <div class="mb-4">
                <label for="foto" class="form-label">Gambar Artikel (Opsional)</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
                <button type="submit" class="btn btn-navy">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
