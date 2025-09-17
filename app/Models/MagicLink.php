<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MagicLink extends Model
{
    protected $fillable = [
        'email',
        'token',
        'expires_at',
        'used_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    /**
     * Generate a new magic link for the given email
     */
    public static function createForEmail(string $email, ?string $ipAddress = null, ?string $userAgent = null): self
    {
        // Invalidate any existing unused magic links for this email
        static::where('email', $email)
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->delete();

        return static::create([
            'email' => $email,
            'token' => Str::random(64),
            'expires_at' => now()->addMinutes(15), // 15 minutes expiry
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);
    }

    /**
     * Check if the magic link is valid
     */
    public function isValid(): bool
    {
        return $this->used_at === null && $this->expires_at->isFuture();
    }

    /**
     * Mark the magic link as used
     */
    public function markAsUsed(): self
    {
        $this->update(['used_at' => now()]);
        return $this;
    }

    /**
     * Find a valid magic link by token
     */
    public static function findValidToken(string $token): ?self
    {
        return static::where('token', $token)
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->first();
    }
}
