<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller {
    public function index() {
        $articles = Article::with('category')->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function create() {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $r) {
        $data = $r->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'slug' => 'required|unique:articles,slug',
            'category_id' => 'required|exists:categories,id',
            'is_publish' => 'required|boolean',
            'published_at' => 'nullable|date',
        ]);
        Article::create($data);
        return redirect()->route('articles.index')
                         ->with('success', 'Artikel berhasil disimpan');
    }

    public function edit(Article $article) {
        $categories = Category::all();
        return view('articles.edit', compact('article','categories'));
    }

    public function update(Request $r, Article $article) {
        $data = $r->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'slug' => 'required|unique:articles,slug,'.$article->id,
            'category_id' => 'required|exists:categories,id',
            'is_publish' => 'required|boolean',
            'published_at' => 'nullable|date',
        ]);
        $article->update($data);
        return redirect()->route('articles.index')
                         ->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(Article $article) {
        $article->delete();
        return redirect()->route('articles.index')
                         ->with('success', 'Artikel berhasil dihapus');
    }
}
