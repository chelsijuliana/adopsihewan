@extends('layouts.app')

@section('title', 'Daftar Hewan')

@section('content')
<div class="container">
    <h2 class="mb-3">📋 Daftar Hewan</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Ras</th>
                <th>Usia</th>
                <th>Pemilik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hewan as $h)
            <tr>
                <td><img src="{{ asset('storage/' . $h->foto) }}" width="100"></td>
                <td>{{ $h->nama }}</td>
                <td>{{ $h->jenis }}</td>
                <td>{{ $h->ras ?? '-' }}</td>
                <td>{{ $h->usia }} th</td>
                <td>{{ $h->user->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('dokter.hewan.detail', $h->id) }}" class="btn btn-info btn-sm">Rekam Medis</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
