<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;
class ArticleSeeder extends Seeder {
    public function run(): void {
        $cat1 = Category::create(['name' => 'Teknologi']);
        $cat2 = Category::create(['name' => 'Gaya Hidup']);
        Article::create(['title' => 'Rilis Laravel 11', 'slug' => 'rilis-laravel-11', 'content' => 'Konten tentang Laravel 11.', 'category_id' => $cat1->id, 'is_publish' => true, 'published_at' => now()]);
        Article::create(['title' => 'Tips Sehat 2025', 'slug' => 'tips-sehat-2025', 'content' => 'Konten tentang hidup sehat.', 'category_id' => $cat2->id, 'is_publish' => true, 'published_at' => now()]);
    }
}