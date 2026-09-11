@extends('layouts.app')

@section('title', 'Daftar Mantan Terindah')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Daftar Mantan Terindah</h3>
        <a href="{{ route('mantan.create') }}" class="btn btn-primary">+ Tambah Mantan</a>
    </div>

    <form method="GET" action="{{ route('mantan.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari nama, no hp, atau alamat...">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Makanan Favorit</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mantans as $mantan)
                        <tr>
                            <td>{{ $mantan->id }}</td>
                            <td>{{ $mantan->nama }}</td>
                            <td>{{ $mantan->no_hp }}</td>
                            <td>{{ $mantan->alamat }}</td>
                            <td>
                                @if($mantan->makanan_favorit)
                                    <span class="badge bg-info text-dark">🍲 {{ $mantan->makanan_favorit }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('mantan.show', $mantan) }}" class="btn btn-sm btn-outline-info">Detail</a>
                                <a href="{{ route('mantan.edit', $mantan) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form action="{{ route('mantan.destroy', $mantan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data mantan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $mantans->links('pagination::bootstrap-5') }}
    </div>
@endsection
