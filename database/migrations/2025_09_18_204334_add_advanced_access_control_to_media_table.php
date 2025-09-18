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
        Schema::table('media', function (Blueprint $table) {
            // Kontrola dostępu
            $table->enum('access_level', ['public', 'authenticated', 'private', 'blocked'])
                  ->default('public')->after('is_public');

            // Blokowanie
            $table->boolean('is_blocked')->default(false)->after('access_level');
            $table->timestamp('blocked_at')->nullable()->after('is_blocked');
            $table->foreignId('blocked_by')->nullable()->constrained('users')->onDelete('set null')->after('blocked_at');
            $table->text('block_reason')->nullable()->after('blocked_by');

            // Dziedziczenie uprawnień
            $table->boolean('inherit_permissions')->default(true)->after('block_reason');

            // Tokeny dostępu
            $table->string('access_token', 64)->nullable()->unique()->after('inherit_permissions');
            $table->timestamp('token_expires_at')->nullable()->after('access_token');

            // Indeksy
            $table->index(['access_level']);
            $table->index(['is_blocked']);
            $table->index(['access_token']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropIndex(['access_level']);
            $table->dropIndex(['is_blocked']);
            $table->dropIndex(['access_token']);

            $table->dropForeign(['blocked_by']);
            $table->dropColumn([
                'access_level',
                'is_blocked',
                'blocked_at',
                'blocked_by',
                'block_reason',
                'inherit_permissions',
                'access_token',
                'token_expires_at'
            ]);
        });
    }
};
