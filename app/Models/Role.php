<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the permissions assigned to this role
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /**
     * Get the users who have this role
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user')
            ->withPivot(['assigned_at', 'assigned_by'])
            ->withTimestamps();
    }

    /**
     * Check if role has a specific permission
     */
    public function hasPermission(string $permission): bool
    {
        return $this->permissions()
            ->where('name', $permission)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Check if role has any of the given permissions
     */
    public function hasAnyPermission(array $permissions): bool
    {
        return $this->permissions()
            ->whereIn('name', $permissions)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Check if role has all of the given permissions
     */
    public function hasAllPermissions(array $permissions): bool
    {
        $rolePermissions = $this->permissions()
            ->whereIn('name', $permissions)
            ->where('is_active', true)
            ->pluck('name')
            ->toArray();

        return count($rolePermissions) === count($permissions);
    }

    /**
     * Assign permission to role
     */
    public function givePermission(Permission|string $permission): void
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }

        $this->permissions()->syncWithoutDetaching([$permission->id]);
    }

    /**
     * Remove permission from role
     */
    public function revokePermission(Permission|string $permission): void
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }

        $this->permissions()->detach($permission->id);
    }

    /**
     * Sync permissions to role
     */
    public function syncPermissions(array $permissions): void
    {
        $permissionIds = collect($permissions)->map(function ($permission) {
            if ($permission instanceof Permission) {
                return $permission->id;
            }
            return Permission::where('name', $permission)->firstOrFail()->id;
        })->toArray();

        $this->permissions()->sync($permissionIds);
    }

    /**
     * Check if role can be deleted (not assigned to any user who is admin)
     */
    public function canBeDeleted(): bool
    {
        return !$this->users()
            ->where('is_admin', true)
            ->exists();
    }

    /**
     * Get active roles only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get roles by permission group
     */
    public function scopeWithPermissionGroup($query, string $group)
    {
        return $query->whereHas('permissions', function ($q) use ($group) {
            $q->where('group', $group);
        });
    }
}