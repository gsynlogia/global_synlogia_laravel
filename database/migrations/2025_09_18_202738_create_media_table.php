<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nazwa pliku wyświetlana użytkownikowi
            $table->string('filename'); // Rzeczywista nazwa pliku na dysku
            $table->string('path'); // Ścieżka do pliku
            $table->string('disk')->default('public'); // Dysk storage (public, private)
            $table->string('mime_type'); // Typ MIME pliku
            $table->bigInteger('size'); // Rozmiar pliku w bajtach
            $table->string('extension'); // Rozszerzenie pliku
            $table->json('metadata')->nullable(); // Dodatkowe metadane (wymiary obrazu, itp.)

            // Hierarchia folderów
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('media')->onDelete('cascade');
            $table->boolean('is_folder')->default(false); // Czy to folder czy plik

            // Uporządkowanie
            $table->integer('sort_order')->default(0);

            // Dodatkowe pola
            $table->text('description')->nullable(); // Opis pliku/folderu
            $table->json('settings')->nullable(); // Ustawienia prywatności, dostępu itp.

            // Kto dodał plik
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');

            // Kontrola dostępu
            $table->boolean('is_public')->default(true);
            $table->timestamp('expires_at')->nullable(); // Data wygaśnięcia dostępu

            $table->timestamps();

            // Indeksy dla wydajności
            $table->index(['parent_id', 'is_folder']);
            $table->index(['mime_type']);
            $table->index(['uploaded_by']);
            $table->index(['is_public']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
