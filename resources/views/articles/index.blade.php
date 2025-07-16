@extends('layout')

@section('title', 'Daftar Artikel')

@section('content')
    <h1>Daftar Artikel</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Buat Artikel Baru</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Dipublikasikan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $a)
                <tr>
                    <td>{{ $a->title }}</td>
                    <td>{{ $a->category->name }}</td>
                    <td>{{ $a->is_publish ? 'Terbit' : 'Draft' }}</td>
                    <td>{{ $a->published_at ?? '-' }}</td>
                    <td>
                        <a href="{{ route('articles.edit', $a) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('articles.destroy', $a) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada artikel</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
