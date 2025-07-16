@extends('layouts.app')
@section('title', 'Edit Artikel')
@section('content')
    <h1>Edit Artikel: {{ $article->title }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $article->title) }}">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($article->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea name="content" class="form-control" id="content" rows="5">{{ old('content', $article->content) }}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_publish" class="form-check-input" id="is_publish" @if($article->is_publish) checked @endif>
            <label class="form-check-label" for="is_publish">Publikasikan</label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection