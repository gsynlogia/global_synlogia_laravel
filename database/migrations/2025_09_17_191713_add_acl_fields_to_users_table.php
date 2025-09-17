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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_blocked')->default(false);
            $table->timestamp('blocked_at')->nullable();
            $table->foreignId('blocked_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('block_reason')->nullable();
            $table->softDeletes();

            $table->index('is_admin');
            $table->index('is_blocked');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['is_admin']);
            $table->dropIndex(['is_blocked']);
            $table->dropIndex(['deleted_at']);

            $table->dropForeign(['blocked_by']);
            $table->dropColumn([
                'is_admin',
                'is_blocked',
                'blocked_at',
                'blocked_by',
                'block_reason',
                'deleted_at'
            ]);
        });
    }
};
