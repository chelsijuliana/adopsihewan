@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="container">
    <h2>📝 Edit Artikel</h2>

    <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $artikel->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Konten</label>
            <textarea name="konten" class="form-control" rows="6" required>{{ $artikel->konten }}</textarea>
        </div>
        <div class="mb-3">
            <label>Ganti Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">
            @if ($artikel->foto)
                <p class="mt-2"><strong>Foto Saat Ini:</strong><br>
                    <img src="{{ asset('storage/' . $artikel->foto) }}" width="150">
                </p>
            @endif
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
