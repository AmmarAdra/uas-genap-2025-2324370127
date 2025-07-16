<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->boolean('is_publish')->default(false);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('articles');
    }
};
