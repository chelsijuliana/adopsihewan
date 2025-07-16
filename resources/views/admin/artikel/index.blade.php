@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', 'Kelola Artikel')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .page-title {
        color: #001f3f;
        font-weight: bold;
        margin-top: 30px;
        margin-bottom: 25px;
    }

    .btn-primary {
        background-color: #001f3f;
        border: none;
    }

    .btn-primary:hover {
        background-color: #003366;
    }

    .table thead {
        background-color: #f0f8ff;
    }

    .table th {
        color: #001f3f;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
    }

    .table img {
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-radius: 8px;
        padding: 10px 15px;
    }

    .btn-warning, .btn-danger {
        padding: 4px 10px;
        font-size: 0.875rem;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border: none;
    }

    .btn-warning:hover {
        background-color: #ec9c2e;
    }

    .btn-danger {
        background-color: #d9534f;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c9302c;
    }
</style>

<div class="container">
    <h2 class="page-title"><i class="bi bi-journal-text me-2"></i>Daftar Artikel</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Artikel
    </a>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Foto</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artikel as $i => $a)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $a->judul }}</td>
                        <td>{{ Str::limit(strip_tags($a->konten), 100, '...') }}</td>
                        <td class="text-center">
                            @if ($a->foto)
                                <img src="{{ asset('storage/' . $a->foto) }}" width="60" height="60" style="object-fit: cover;">
                            @else
                                <em>Tidak ada</em>
                            @endif
                        </td>
                        <td>{{ $a->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.artikel.edit', $a->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.artikel.delete', $a->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
