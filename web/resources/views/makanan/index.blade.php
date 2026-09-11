@extends('layouts.app')

@section('title', 'Daftar Makanan Favorit')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">🍲 Daftar Makanan Favorit</h3>
        <a href="{{ route('makanan-favorit.create') }}" class="btn btn-primary">+ Tambah Makanan Favorit</a>
    </div>

    <form method="GET" action="{{ route('makanan-favorit.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari nama makanan atau deskripsi...">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 80px;">#</th>
                        <th>Nama Makanan</th>
                        <th>Deskripsi</th>
                        <th class="text-end" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($makanans as $makanan)
                        <tr>
                            <td>{{ $makanan->id }}</td>
                            <td class="fw-bold">{{ $makanan->nama_makanan }}</td>
                            <td>{{ $makanan->deskripsi ?: '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('makanan-favorit.edit', $makanan) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form action="{{ route('makanan-favorit.destroy', $makanan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus makanan favorit ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data makanan favorit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $makanans->links('pagination::bootstrap-5') }}
    </div>
@endsection
