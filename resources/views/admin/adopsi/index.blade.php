@extends('layouts.app')

@section('title', 'Permintaan Adopsi')

@section('content')
<!-- Bootstrap Icons (jika belum ada di layout) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .page-title {
        color: #001f3f;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .table thead {
        background-color: #f0f8ff;
        color: #001f3f;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    .badge-warning {
        background-color: #ffe08a !important;
        color: #5f4b00 !important;
    }

    .badge-success {
        background-color: #4caf50 !important;
    }

    .badge-danger {
        background-color: #dc3545 !important;
    }

    .badge-secondary {
        background-color: #6c757d !important;
    }
</style>

<div class="container">
    <h2 class="page-title"><i class="bi bi-clipboard-check me-2"></i>Daftar Permintaan Adopsi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Hewan</th>
                    <th>Adopter</th>
                    <th>Alasan</th>
                    <th>Pengalaman</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permintaan as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="fw-semibold text-primary">{{ $p->hewan->nama ?? '-' }}</td>
                    <td>{{ $p->adopter->name ?? '-' }}</td>
                    <td class="text-start">{{ $p->alasan ?? '-' }}</td>
                    <td class="text-start">{{ $p->pengalaman ?? '-' }}</td>
                    <td>
                        @if ($p->status == 'pending' || $p->status == 'menunggu')
                            <span class="badge badge-warning">Pending</span>
                        @elseif ($p->status == 'disetujui')
                            <span class="badge badge-success">Disetujui</span>
                        @elseif ($p->status == 'ditolak')
                            <span class="badge badge-danger">Ditolak</span>
                        @else
                            <span class="badge badge-secondary">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
