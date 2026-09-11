@extends('layouts.app')

@section('title', 'Edit Makanan Favorit')

@section('content')
    <h3 class="mb-3">Edit Makanan Favorit</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('makanan-favorit.update', $makanan) }}" method="POST">
                @csrf
                @method('PUT')

                @include('makanan._form')

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('makanan-favorit.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
