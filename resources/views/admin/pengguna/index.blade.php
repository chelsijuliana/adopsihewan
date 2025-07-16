@extends('layouts.app')

@section('title', 'Daftar Pengguna')

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

    .table thead {
        background-color: #f0f8ff;
    }

    .table th {
        color: #001f3f;
        vertical-align: middle;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border: none;
    }

    .btn-danger {
        background-color: #d9534f;
        border: none;
    }

    .btn-warning:hover {
        background-color: #ec9c2e;
    }

    .btn-danger:hover {
        background-color: #c9302c;
    }

    .table img {
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-radius: 8px;
        padding: 10px 15px;
    }
</style>

<div class="container">
    <h2 class="page-title"><i class="bi bi-people-fill me-2"></i>Daftar Pengguna</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengguna as $i => $user)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="text-start">{{ $user->name }}</td>
                    <td class="text-start">{{ $user->email }}</td>
                    <td><span class="badge bg-primary text-capitalize">{{ $user->role }}</span></td>
                    <td>{{ $user->phone ?? '-' }}</td>
                    <td class="text-start">{{ $user->address ?? '-' }}</td>
                    <td>
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto" width="60" height="60" style="object-fit: cover;">
                        @else
                            <em>Tidak ada</em>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn btn-warning btn-sm mb-1">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.pengguna.delete', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
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
