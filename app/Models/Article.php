<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Article extends Model {
    use HasFactory;
    protected $fillable = ['title', 'slug', 'content', 'category_id', 'is_publish', 'published_at'];
    protected $casts = ['is_publish' => 'boolean', 'published_at' => 'datetime'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}