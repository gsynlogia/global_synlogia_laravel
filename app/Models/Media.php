<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $fillable = [
        'name',
        'filename',
        'path',
        'disk',
        'mime_type',
        'size',
        'extension',
        'metadata',
        'parent_id',
        'is_folder',
        'sort_order',
        'description',
        'settings',
        'uploaded_by',
        'is_public',
        'expires_at',
        // Nowe pola kontroli dostępu
        'access_level',
        'is_blocked',
        'blocked_at',
        'blocked_by',
        'block_reason',
        'inherit_permissions',
        'access_token',
        'token_expires_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'settings' => 'array',
        'is_folder' => 'boolean',
        'is_public' => 'boolean',
        'expires_at' => 'datetime',
        // Nowe pola
        'is_blocked' => 'boolean',
        'blocked_at' => 'datetime',
        'inherit_permissions' => 'boolean',
        'token_expires_at' => 'datetime',
    ];

    // Relacje
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Media::class, 'parent_id')->orderBy('sort_order');
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function blockedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'blocked_by');
    }

    public function authorizedUsers()
    {
        return $this->belongsToMany(User::class, 'media_users')
            ->withPivot(['permission', 'granted_at', 'granted_by', 'expires_at'])
            ->withTimestamps();
    }

    // Scopes
    public function scopeFolders($query)
    {
        return $query->where('is_folder', true);
    }

    public function scopeFiles($query)
    {
        return $query->where('is_folder', false);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeInFolder($query, $folderId = null)
    {
        return $query->where('parent_id', $folderId);
    }

    public function scopeNotBlocked($query)
    {
        return $query->where('is_blocked', false);
    }

    public function scopeAccessibleToUser($query, $user = null)
    {
        if (!$user) {
            return $query->where('access_level', 'public')->notBlocked();
        }

        return $query->where(function ($q) use ($user) {
            $q->where('access_level', 'public')
              ->orWhere('uploaded_by', $user->id)
              ->orWhere(function ($subQ) use ($user) {
                  $subQ->where('access_level', 'authenticated');
              })
              ->orWhere(function ($subQ) use ($user) {
                  $subQ->where('access_level', 'private')
                       ->whereHas('authorizedUsers', function ($authQ) use ($user) {
                           $authQ->where('user_id', $user->id)
                                 ->where(function ($expQ) {
                                     $expQ->whereNull('expires_at')
                                          ->orWhere('expires_at', '>', now());
                                 });
                       });
              });
        })->notBlocked();
    }

    // Helpery
    public function getFullPath(): string
    {
        if ($this->is_folder) {
            return '';
        }

        return Storage::disk($this->disk)->path($this->path);
    }

    public function getUrl(): string
    {
        if ($this->is_folder) {
            return '';
        }

        // Użyj publicznego route'a zamiast bezpośredniego dostępu do storage
        return route('media.public.show', $this->id);
    }

    public function getDirectUrl(): string
    {
        if ($this->is_folder) {
            return '';
        }

        return Storage::disk($this->disk)->url($this->path);
    }

    public function getHumanReadableSize(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function isImage(): bool
    {
        return Str::startsWith($this->mime_type, 'image/');
    }

    public function isVideo(): bool
    {
        return Str::startsWith($this->mime_type, 'video/');
    }

    public function isAudio(): bool
    {
        return Str::startsWith($this->mime_type, 'audio/');
    }

    public function isDocument(): bool
    {
        $documentTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
        ];

        return in_array($this->mime_type, $documentTypes);
    }

    public function getTypeCategory(): string
    {
        if ($this->is_folder) return 'folder';
        if ($this->isImage()) return 'image';
        if ($this->isVideo()) return 'video';
        if ($this->isAudio()) return 'audio';
        if ($this->isDocument()) return 'document';

        return 'file';
    }

    public function getIcon(): string
    {
        switch ($this->getTypeCategory()) {
            case 'folder':
                return 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z';
            case 'image':
                return 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z';
            case 'video':
                return 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z';
            case 'audio':
                return 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3';
            case 'document':
                return 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z';
            default:
                return 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z';
        }
    }

    public function getBreadcrumb(): array
    {
        $breadcrumb = [];
        $current = $this;

        while ($current && $current->parent) {
            $breadcrumb[] = $current->parent;
            $current = $current->parent;
        }

        return array_reverse($breadcrumb);
    }

    // Metody kontroli dostępu
    public function canBeAccessedBy($user = null): bool
    {
        // Sprawdź blokadę
        if ($this->is_blocked) {
            return false;
        }

        // Sprawdź token dostępu
        if ($this->access_token && request()->get('token') === $this->access_token) {
            if (!$this->token_expires_at || $this->token_expires_at->isFuture()) {
                return true;
            }
        }

        // Jeśli plik ma parent folder, sprawdź dostęp do folderu
        if ($this->parent_id && !$this->is_folder) {
            $parent = $this->parent;
            if ($parent && !$parent->canBeAccessedBy($user)) {
                return false;
            }
        }

        switch ($this->access_level) {
            case 'public':
                return true;

            case 'authenticated':
                return $user !== null;

            case 'private':
                if (!$user) {
                    return false;
                }

                // Właściciel ma zawsze dostęp
                if ($this->uploaded_by === $user->id) {
                    return true;
                }

                // Sprawdź autoryzowanych użytkowników
                return $this->authorizedUsers()
                    ->where('user_id', $user->id)
                    ->where(function ($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    })
                    ->exists();

            case 'blocked':
                return false;

            default:
                return false;
        }
    }

    public function hasPermission($user, string $permission): bool
    {
        if (!$this->canBeAccessedBy($user)) {
            return false;
        }

        // Właściciel i admini mają wszystkie uprawnienia
        if ($user && ($this->uploaded_by === $user->id || $user->isAdmin())) {
            return true;
        }

        if ($this->access_level === 'public') {
            return in_array($permission, ['view']);
        }

        if ($this->access_level === 'authenticated' && $user) {
            return in_array($permission, ['view', 'download']);
        }

        if ($this->access_level === 'private' && $user) {
            $userPermission = $this->authorizedUsers()
                ->where('user_id', $user->id)
                ->first();

            if (!$userPermission) {
                return false;
            }

            $permissions = [
                'view' => ['view', 'download', 'edit', 'admin'],
                'download' => ['download', 'edit', 'admin'],
                'edit' => ['edit', 'admin'],
                'admin' => ['admin'],
            ];

            return in_array($userPermission->pivot->permission, $permissions[$permission] ?? []);
        }

        return false;
    }

    public function block(User $user, string $reason = null): bool
    {
        $this->update([
            'is_blocked' => true,
            'blocked_at' => now(),
            'blocked_by' => $user->id,
            'block_reason' => $reason,
        ]);

        return true;
    }

    public function unblock(): bool
    {
        $this->update([
            'is_blocked' => false,
            'blocked_at' => null,
            'blocked_by' => null,
            'block_reason' => null,
        ]);

        return true;
    }

    public function generateAccessToken(int $expiresInHours = null): string
    {
        $token = Str::random(64);

        $this->update([
            'access_token' => $token,
            'token_expires_at' => $expiresInHours ? now()->addHours($expiresInHours) : null,
        ]);

        return $token;
    }

    public function revokeAccessToken(): bool
    {
        $this->update([
            'access_token' => null,
            'token_expires_at' => null,
        ]);

        return true;
    }

    public function getAccessLevelLabel(): string
    {
        return match($this->access_level) {
            'public' => 'Publiczny',
            'authenticated' => 'Tylko zalogowani',
            'private' => 'Prywatny',
            'blocked' => 'Zablokowany',
            default => 'Nieznany'
        };
    }

    // Automatyczne usuwanie pliku z dysku przy usuwaniu rekordu
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($media) {
            if (!$media->is_folder && $media->path) {
                Storage::disk($media->disk)->delete($media->path);
            }
        });
    }
}
