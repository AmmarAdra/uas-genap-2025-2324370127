@extends('layout')

@section('title', 'Tambah Artikel')

@section('content')
    <h1>Tambah Artikel</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label>Konten</label>
            <textarea name="content" class="form-control">{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_publish" value="1" class="form-check-input" {{ old('is_publish') ? 'checked' : '' }}>
            <label class="form-check-label">Publikasikan</label>
        </div>

        <div class="mb-3">
            <label>Tanggal Publikasi</label>
            <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
