<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is a superuser (hardcoded in .env)
     *
     * @return bool
     */
    public function isSuperuser(): bool
    {
        $superusers = explode(',', env('SUPERUSERS', ''));
        $superusers = array_map('trim', $superusers);

        return in_array($this->email, $superusers);
    }

    /**
     * Check if user is an administrator (superuser or has admin role in database)
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        // First check if user is hardcoded superuser
        if ($this->isSuperuser()) {
            return true;
        }

        // Later we'll add database role checking here for ACL
        // For now, only superusers are admins
        return false;
    }

    /**
     * Get all superuser emails from configuration
     *
     * @return array
     */
    public static function getSuperuserEmails(): array
    {
        $superusers = explode(',', env('SUPERUSERS', ''));
        return array_map('trim', $superusers);
    }
}
