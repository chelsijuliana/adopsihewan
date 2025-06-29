@extends('layouts.app')

@section('title', 'Kelola Artikel')

@section('content')
<div class="container">
    <h2>📚 Daftar Artikel Edukasi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary mb-3">+ Tambah Artikel</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artikel as $i => $a)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $a->judul }}</td>
                <td>{{ $a->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.artikel.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.artikel.destroy', $a->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus artikel ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
