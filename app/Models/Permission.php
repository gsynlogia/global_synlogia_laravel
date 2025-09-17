<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'group',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the roles that have this permission
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    /**
     * Check if permission can be deleted (not assigned to any admin role)
     */
    public function canBeDeleted(): bool
    {
        return !$this->roles()
            ->whereHas('users', function ($q) {
                $q->where('is_admin', true);
            })
            ->exists();
    }

    /**
     * Get active permissions only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get permissions by group
     */
    public function scopeInGroup($query, string $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Get permissions by multiple groups
     */
    public function scopeInGroups($query, array $groups)
    {
        return $query->whereIn('group', $groups);
    }

    /**
     * Get all permission groups
     */
    public static function getGroups(): array
    {
        return self::distinct('group')
            ->where('is_active', true)
            ->pluck('group')
            ->sort()
            ->toArray();
    }

    /**
     * Get permissions grouped by their group
     */
    public static function getGroupedPermissions(): array
    {
        return self::active()
            ->orderBy('group')
            ->orderBy('display_name')
            ->get()
            ->groupBy('group')
            ->toArray();
    }

    /**
     * Create basic CRUD permissions for a group
     */
    public static function createCrudPermissions(string $group, string $displayGroupName): array
    {
        $actions = [
            'create' => 'Tworzenie',
            'read' => 'Przeglądanie',
            'update' => 'Edycja',
            'delete' => 'Usuwanie (miękkie)',
            'force_delete' => 'Usuwanie (twarde)',
            'restore' => 'Przywracanie',
        ];

        $permissions = [];

        foreach ($actions as $action => $displayAction) {
            $permission = self::firstOrCreate([
                'name' => "{$group}.{$action}",
            ], [
                'display_name' => "{$displayAction} - {$displayGroupName}",
                'description' => "{$displayAction} zawartości w sekcji {$displayGroupName}",
                'group' => $group,
                'is_active' => true,
            ]);

            $permissions[] = $permission;
        }

        return $permissions;
    }

    /**
     * Common permission groups and their display names
     */
    public static function getGroupDisplayNames(): array
    {
        return [
            'blog' => 'Blog',
            'training' => 'Szkolenia',
            'contact' => 'Kontakt',
            'slider' => 'Slider',
            'badge_slider' => 'Badge Slider',
            'services' => 'Usługi',
            'technologies' => 'Technologie',
            'users' => 'Użytkownicy',
            'roles' => 'Role',
            'permissions' => 'Uprawnienia',
            'trash' => 'Kosz',
        ];
    }
}