@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container">
    <h2>📝 Tambah Artikel Baru</h2>

    <form action="{{ route('admin.artikel.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Isi Artikel</label>
            <textarea name="isi" class="form-control" rows="5" required></textarea>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
