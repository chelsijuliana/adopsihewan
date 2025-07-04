@extends('layouts.app')

@section('title', 'Kelola Artikel')

@section('content')
<div class="container">
    <h2>📰 Daftar Artikel</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary mb-3">+ Tambah Artikel</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artikel as $a)
                <tr>
                    <td>{{ $a->judul }}</td>
                    <td>{{ $a->penulis->nama ?? '-' }}</td>
                    <td>{{ $a->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('admin.artikel.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.artikel.delete', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>

                        {{-- Bisa tambah edit & delete jika ingin --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
