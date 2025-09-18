<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_blocked',
        'blocked_at',
        'blocked_by',
        'block_reason',
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
            'is_admin' => 'boolean',
            'is_blocked' => 'boolean',
            'blocked_at' => 'datetime',
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

        // Check if user has admin flag in database
        return $this->is_admin;
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

    // === ROLE RELATIONSHIPS ===

    /**
     * Get the roles assigned to this user
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')
            ->withPivot(['assigned_at', 'assigned_by'])
            ->withTimestamps();
    }

    /**
     * Get the user who blocked this user
     */
    public function blockedBy()
    {
        return $this->belongsTo(User::class, 'blocked_by');
    }

    // === PERMISSION METHODS ===

    /**
     * Check if user has a specific permission
     */
    public function hasPermission(string $permission): bool
    {
        // Superusers and admins have all permissions
        if ($this->isSuperuser() || $this->isAdmin()) {
            return true;
        }

        // Check if user is blocked
        if ($this->isBlocked()) {
            return false;
        }

        // Check permission through roles
        return $this->roles()
            ->whereHas('permissions', function ($q) use ($permission) {
                $q->where('name', $permission)
                  ->where('is_active', true);
            })
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Check if user has any of the given permissions
     */
    public function hasAnyPermission(array $permissions): bool
    {
        // Superusers and admins have all permissions
        if ($this->isSuperuser() || $this->isAdmin()) {
            return true;
        }

        // Check if user is blocked
        if ($this->isBlocked()) {
            return false;
        }

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user has all of the given permissions
     */
    public function hasAllPermissions(array $permissions): bool
    {
        // Superusers and admins have all permissions
        if ($this->isSuperuser() || $this->isAdmin()) {
            return true;
        }

        // Check if user is blocked
        if ($this->isBlocked()) {
            return false;
        }

        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get all permissions for this user (through roles)
     */
    public function getAllPermissions()
    {
        if ($this->isSuperuser() || $this->isAdmin()) {
            return Permission::active()->get();
        }

        if ($this->isBlocked()) {
            return collect();
        }

        return Permission::whereHas('roles', function ($q) {
            $q->whereIn('role_id', $this->roles()->pluck('roles.id'));
        })->active()->get();
    }

    // === ROLE METHODS ===

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()
            ->where('name', $role)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()
            ->whereIn('name', $roles)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Assign role to user
     */
    public function assignRole(Role|string $role, ?User $assignedBy = null): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching([
            $role->id => [
                'assigned_by' => $assignedBy?->id,
                'assigned_at' => now(),
            ]
        ]);
    }

    /**
     * Remove role from user
     */
    public function removeRole(Role|string $role): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->detach($role->id);
    }

    /**
     * Sync roles for user
     */
    public function syncRoles(array $roles, ?User $assignedBy = null): void
    {
        $roleData = [];

        foreach ($roles as $role) {
            if ($role instanceof Role) {
                $roleId = $role->id;
            } else {
                $roleId = Role::where('name', $role)->firstOrFail()->id;
            }

            $roleData[$roleId] = [
                'assigned_by' => $assignedBy?->id,
                'assigned_at' => now(),
            ];
        }

        $this->roles()->sync($roleData);
    }

    // === BLOCKING METHODS ===

    /**
     * Check if user is blocked
     */
    public function isBlocked(): bool
    {
        return (bool) $this->is_blocked;
    }

    /**
     * Block user
     */
    public function block(?string $reason = null, ?User $blockedBy = null): void
    {
        $this->update([
            'is_blocked' => true,
            'blocked_at' => now(),
            'blocked_by' => $blockedBy?->id,
            'block_reason' => $reason,
        ]);

        // Add note to history
        $this->addNote(
            'block',
            'Użytkownik został zablokowany',
            'Status użytkownika zmieniony z aktywny na zablokowany przez administratora.' .
            ($reason ? ' Powód: ' . $reason : ''),
            [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'previous_status' => 'active',
                'new_status' => 'blocked',
                'block_reason' => $reason
            ],
            $blockedBy
        );
    }

    /**
     * Unblock user
     */
    public function unblock(?User $unblockedBy = null): void
    {
        $this->update([
            'is_blocked' => false,
            'blocked_at' => null,
            'blocked_by' => null,
            'block_reason' => null,
        ]);

        // Add note to history
        $this->addNote(
            'unblock',
            'Użytkownik został odblokowany',
            'Status użytkownika zmieniony z zablokowany na aktywny przez administratora.',
            [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'previous_status' => 'blocked',
                'new_status' => 'active'
            ],
            $unblockedBy ?: auth()->user()
        );
    }

    // === DELETION METHODS ===

    /**
     * Check if user can be deleted by another user
     */
    public function canBeDeletedBy(User $user): bool
    {
        // Superusers cannot be deleted
        if ($this->isSuperuser()) {
            return false;
        }

        // Only superusers and admins can delete users
        if (!$user->isSuperuser() && !$user->isAdmin()) {
            return false;
        }

        // Admins cannot delete other admins
        if ($this->isAdmin() && !$user->isSuperuser()) {
            return false;
        }

        return true;
    }

    /**
     * Check if user can be force deleted by another user
     */
    public function canBeForceDeletedBy(User $user): bool
    {
        // Only superusers and admins can force delete
        return $user->isSuperuser() || $user->isAdmin();
    }

    /**
     * Check if user can be blocked by another user
     */
    public function canBeBlockedBy(User $user): bool
    {
        // Superusers cannot be blocked
        if ($this->isSuperuser()) {
            return false;
        }

        // Only superusers and admins can block users
        if (!$user->isSuperuser() && !$user->isAdmin()) {
            return false;
        }

        // Admins cannot block other admins
        if ($this->isAdmin() && !$user->isSuperuser()) {
            return false;
        }

        return true;
    }

    // === SCOPES ===

    /**
     * Get only active (non-blocked, non-deleted) users
     */
    public function scopeActive($query)
    {
        return $query->where('is_blocked', false);
    }

    /**
     * Get only blocked users
     */
    public function scopeBlocked($query)
    {
        return $query->where('is_blocked', true);
    }

    /**
     * Get only admin users
     */
    public function scopeAdmins($query)
    {
        return $query->where('is_admin', true);
    }

    /**
     * Get only non-admin users
     */
    public function scopeRegularUsers($query)
    {
        return $query->where('is_admin', false);
    }

    /**
     * Get user notes (history)
     */
    public function notes()
    {
        return $this->hasMany(UserNote::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get notes created by this user
     */
    public function createdNotes()
    {
        return $this->hasMany(UserNote::class, 'created_by');
    }

    /**
     * Add a note to user history
     */
    public function addNote(string $type, string $title, string $content, array $metadata = [], ?User $createdBy = null)
    {
        return $this->notes()->create([
            'type' => $type,
            'title' => $title,
            'content' => $content,
            'metadata' => $metadata,
            'created_by' => $createdBy ? $createdBy->id : auth()->id()
        ]);
    }
}
