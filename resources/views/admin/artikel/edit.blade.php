@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="container">
    <h2>✏️ Edit Artikel</h2>

    <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $artikel->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Isi Artikel</label>
            <textarea name="isi" class="form-control" rows="5" required>{{ $artikel->isi }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
