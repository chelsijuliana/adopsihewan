@extends('layouts.app')

@section('title', 'Semua Data Hewan')

@section('content')
<div class="container">
    <h2>🐾 Daftar Semua Hewan</h2>

    <table class="table table-bordered table-hover mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Ras</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Pemberi Hibah</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hewan as $i => $h)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $h->nama }}</td>
                <td>{{ $h->jenis }}</td>
                <td>{{ $h->ras ?? '-' }}</td>
                <td>{{ $h->usia }} tahun</td>
                <td>{{ ucfirst($h->jenis_kelamin) }}</td>
                <td>{{ $h->user->name ?? '-' }}</td>
                <td>
                    <img src="{{ asset('storage/' . $h->foto) }}" width="80" style="object-fit: cover;">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
