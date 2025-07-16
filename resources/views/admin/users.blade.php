@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="container">
    <h2>👥 Daftar Pengguna</h2>

    <table class="table table-bordered table-striped mt-3">
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
            @foreach($users as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td> <!-- Tanpa badge -->
                <td>{{ $user->phone ?? '-' }}</td>
                <td>{{ $user->address ?? '-' }}</td>
                <td>
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto" width="50" height="50" class="rounded-circle">
                    @else
                        <em>Tidak ada</em>
                    @endif
                </td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.pengguna.delete', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
 