<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Article;

class ArticleSeeder extends Seeder {
    public function run(): void {
        Article::create([
            'title' => 'Contoh Artikel',
            'content' => 'Lorem ipsum...',
            'slug' => Str::slug('Contoh Artikel'),
            'category_id' => 1,
            'is_publish' => true,
            'published_at' => now(),
        ]);
    }
}
