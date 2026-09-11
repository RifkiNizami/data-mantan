@extends('layouts.app')

@section('title', 'Tambah Makanan Favorit')

@section('content')
    <h3 class="mb-3">Tambah Makanan Favorit</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('makanan-favorit.store') }}" method="POST">
                @csrf

                @include('makanan._form')

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('makanan-favorit.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
