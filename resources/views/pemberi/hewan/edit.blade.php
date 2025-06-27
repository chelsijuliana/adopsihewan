@extends('layouts.app')

@section('title', 'Edit Hewan')

@section('content')
<div class="container">
    <h2>✏️ Edit Hewan</h2>

    <form action="/pemberi/hewan/update/{{ $hewan->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Hewan</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $hewan->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror" value="{{ old('jenis', $hewan->jenis) }}" required>
            @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ras</label>
            <input type="text" name="ras" class="form-control @error('ras') is-invalid @enderror" value="{{ old('ras', $hewan->ras) }}">
            @error('ras')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Usia</label>
            <input type="number" name="usia" class="form-control @error('usia') is-invalid @enderror" value="{{ old('usia', $hewan->usia) }}" required>
            @error('usia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                <option value="">-- Pilih --</option>
                <option value="jantan" {{ old('jenis_kelamin', $hewan->jenis_kelamin) == 'jantan' ? 'selected' : '' }}>Jantan</option>
                <option value="betina" {{ old('jenis_kelamin', $hewan->jenis_kelamin) == 'betina' ? 'selected' : '' }}>Betina</option>
            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $hewan->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ganti Foto (opsional)</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <p class="mt-2"><strong>Foto Saat Ini:</strong><br>
                <img src="{{ asset('storage/' . $hewan->foto) }}" width="150">
            </p>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="/pemberi/hewan" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
