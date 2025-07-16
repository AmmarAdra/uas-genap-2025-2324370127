@extends('layouts.app')
@section('title', 'Daftar Artikel')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Artikel</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Buat Artikel Baru</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr><th>Judul</th><th>Kategori</th><th>Status</th><th width="180px">Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td><span class="badge {{ $article->is_publish ? 'bg-success' : 'bg-secondary' }}">{{ $article->is_publish ? 'Published' : 'Draft' }}</span></td>
                    <td>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada artikel.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection