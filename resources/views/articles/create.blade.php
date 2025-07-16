@extends('layouts.app')

@section('title', 'Buat Artikel Baru')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Buat Artikel Baru</h1>

            {{-- Menampilkan error validasi jika ada --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Terjadi beberapa masalah dengan input Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('articles.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="title">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                {{-- ▼▼▼ INI BAGIAN PILIHAN KATEGORI ▼▼▼ --}}
                <div class="form-group mb-3">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        {{-- Looping untuk menampilkan setiap kategori dari database --}}
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- ▲▲▲ BATAS AKHIR BAGIAN KATEGORI ▲▲▲ --}}

                <div class="form-group mb-3">
                    <label for="content">Konten</label>
                    <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection