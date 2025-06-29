@extends('layouts.app')

@section('title', 'Permintaan Adopsi')

@section('content')
<div class="container">
    <h2>📋 Daftar Permintaan Adopsi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Hewan</th>
                <th>Adopter</th>
                <th>Alasan</th>
                <th>Pengalaman</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permintaan as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->hewan->nama ?? '-' }}</td>
                <td>{{ $p->adopter->name ?? '-' }}</td>
                <td>{{ $p->alasan ?? '-' }}</td>
                <td>{{ $p->pengalaman ?? '-' }}</td>
                <td>
                    @if ($p->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif ($p->status == 'disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </td>
                <td>
                    @if ($p->status === 'pending')
                        <form action="{{ route('admin.adopsi.setujui', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Setujui</button>
                        </form>
                        <form action="{{ route('admin.adopsi.tolak', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                    @else
                        <small>-</small>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
