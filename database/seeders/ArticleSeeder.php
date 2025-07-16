<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Article;

class ArticleSeeder extends Seeder {
    public function run(): void {
        Article::truncate(); // Hapus semua data lama untuk mencegah konflik slug

        Article::create([
            'title' => 'Contoh Artikel',
            'content' => 'Lorem ipsum...',
            'slug' => Str::slug('Contoh Artikel') . '-' . Str::random(5), // Buat slug unik
            'category_id' => 1,
            'is_publish' => true,
            'published_at' => now(),
        ]);
    }
}
