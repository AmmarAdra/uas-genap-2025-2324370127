<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::with('category')->latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function create() {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']).'-'.time(),
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'is_publish' => $request->has('is_publish'),
            'published_at' => $request->has('is_publish') ? now() : null,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function show(Article $article) {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article) {
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']).'-'.time(),
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'is_publish' => $request->has('is_publish'),
            'published_at' => $request->has('is_publish') ? now() : $article->published_at,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article) {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}