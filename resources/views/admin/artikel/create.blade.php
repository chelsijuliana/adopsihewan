@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container">
    <h2>✍️ Tambah Artikel</h2>

    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Judul Artikel</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Konten</label>
            <textarea name="konten" class="form-control" rows="6" required></textarea>
        </div>
        <div class="mb-3">
            <label>Gambar (Opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
