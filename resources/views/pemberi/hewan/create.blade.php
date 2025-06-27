@extends('layouts.app')

@section('title', 'Tambah Hewan')

@section('content')
<div class="container">
    <h2>➕ Tambah Hewan</h2>

    <form action="/pemberi/hewan/tambah" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Hewan</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
            @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ras</label>
            <input type="text" name="ras" class="form-control @error('ras') is-invalid @enderror">
            @error('ras')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Usia</label>
            <input type="number" name="usia" class="form-control @error('usia') is-invalid @enderror" required>
            @error('usia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                <option value="">-- Pilih --</option>
                <option value="jantan">Jantan</option>
                <option value="betina">Betina</option>
            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3"></textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" required>
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="/pemberi/hewan" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
