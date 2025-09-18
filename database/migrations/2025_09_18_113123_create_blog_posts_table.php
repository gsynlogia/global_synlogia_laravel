<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Uruchomienie migracji - tworzenie tabeli blog_posts
     */
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();

            // Podstawowe informacje o artykule
            $table->string('title'); // Tytuł artykułu
            $table->string('slug')->unique(); // Slug do URL
            $table->text('excerpt')->nullable(); // Krótki opis
            $table->longText('content'); // Treść artykułu
            $table->string('featured_image')->nullable(); // Główne zdjęcie (path lub URL)
            $table->boolean('featured_image_is_url')->default(false); // Czy to URL czy plik

            // Status publikacji
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // Status: szkic, opublikowany, zarchiwizowany
            $table->boolean('is_enabled')->default(true); // Czy artykuł jest włączony

            // Daty publikacji
            $table->timestamp('published_at')->nullable(); // Data publikacji
            $table->timestamp('published_until')->nullable(); // Data zakończenia publikacji (opcjonalne)

            // Zabezpieczenie hasłem
            $table->string('password')->nullable(); // Hasło do artykułu (hashed)
            $table->boolean('is_password_protected')->default(false); // Czy chroniony hasłem

            // Relacje
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // Autor artykułu

            // Metadane SEO
            $table->string('meta_title')->nullable(); // Meta tytuł
            $table->text('meta_description')->nullable(); // Meta opis
            $table->json('meta_keywords')->nullable(); // Słowa kluczowe jako JSON

            // Liczniki
            $table->integer('views_count')->default(0); // Liczba wyświetleń

            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at

            // Indeksy dla wydajności
            $table->index(['status', 'is_enabled', 'published_at']);
            $table->index(['author_id']);
            $table->index(['slug']);
            $table->index(['created_at']);
        });
    }

    /**
     * Cofnięcie migracji - usunięcie tabeli blog_posts
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
