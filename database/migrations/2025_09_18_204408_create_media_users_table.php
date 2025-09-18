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
        Schema::create('media_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('permission', ['view', 'download', 'edit', 'admin'])->default('view');
            $table->timestamp('granted_at')->useCurrent();
            $table->foreignId('granted_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            // Unikalny klucz - jeden użytkownik może mieć tylko jedno uprawnienie do pliku
            $table->unique(['media_id', 'user_id']);

            // Indeksy
            $table->index(['user_id', 'permission']);
            $table->index(['expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_users');
    }
};
