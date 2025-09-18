<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Model reprezentujący wpisy na blogu
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $excerpt
 * @property string $content
 * @property string|null $featured_image
 * @property bool $featured_image_is_url
 * @property string $status
 * @property bool $is_enabled
 * @property \Carbon\Carbon|null $published_at
 * @property \Carbon\Carbon|null $published_until
 * @property string|null $password
 * @property bool $is_password_protected
 * @property int $author_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property array|null $meta_keywords
 * @property int $views_count
 */
class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nazwa tabeli w bazie danych
     */
    protected $table = 'blog_posts';

    /**
     * Pola które można masowo przypisywać
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'featured_image_is_url',
        'status',
        'is_enabled',
        'published_at',
        'published_until',
        'password',
        'is_password_protected',
        'author_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'views_count',
    ];

    /**
     * Rzutowanie typów pól
     */
    protected $casts = [
        'featured_image_is_url' => 'boolean',
        'is_enabled' => 'boolean',
        'published_at' => 'datetime',
        'published_until' => 'datetime',
        'is_password_protected' => 'boolean',
        'meta_keywords' => 'array',
        'views_count' => 'integer',
    ];

    /**
     * Pola ukryte podczas serializacji
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Statusy artykułów
     */
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    /**
     * Dostępne statusy
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_DRAFT => 'Szkic',
            self::STATUS_PUBLISHED => 'Opublikowany',
            self::STATUS_ARCHIVED => 'Zarchiwizowany',
        ];
    }

    /**
     * Relacja z autorem artykułu
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope - tylko opublikowane artykuły
     */
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
                    ->where('is_enabled', true)
                    ->where(function($q) {
                        $q->whereNull('published_at')
                          ->orWhere('published_at', '<=', now());
                    })
                    ->where(function($q) {
                        $q->whereNull('published_until')
                          ->orWhere('published_until', '>=', now());
                    });
    }

    /**
     * Scope - tylko szkice
     */
    public function scopeDrafts($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    /**
     * Scope - tylko zarchiwizowane
     */
    public function scopeArchived($query)
    {
        return $query->where('status', self::STATUS_ARCHIVED);
    }

    /**
     * Scope - tylko włączone
     */
    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    /**
     * Automatyczne tworzenie slug z tytułu
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /**
     * Ustawienie hasła do artykułu (plain text dla dostępu do artykułów)
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = $value; // Przechowywanie jako plain text
            $this->attributes['is_password_protected'] = true;
        } else {
            $this->attributes['password'] = null;
            $this->attributes['is_password_protected'] = false;
        }
    }

    /**
     * Sprawdzenie czy hasło jest poprawne (porównanie plain text)
     */
    public function checkPassword(string $password): bool
    {
        if (!$this->is_password_protected || empty($this->password)) {
            return true;
        }

        return $password === $this->password; // Porównanie plain text
    }

    /**
     * Sprawdzenie czy artykuł jest publicznie dostępny
     */
    public function isPubliclyAccessible(): bool
    {
        if ($this->status !== self::STATUS_PUBLISHED || !$this->is_enabled) {
            return false;
        }

        // Sprawdzenie daty publikacji
        if ($this->published_at && $this->published_at->isFuture()) {
            return false;
        }

        // Sprawdzenie daty zakończenia publikacji
        if ($this->published_until && $this->published_until->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Inkrementacja licznika wyświetleń
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Pobranie URL do głównego zdjęcia
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (empty($this->featured_image)) {
            return null;
        }

        if ($this->featured_image_is_url) {
            return $this->featured_image;
        }

        return asset('storage/' . $this->featured_image);
    }

    /**
     * Pobranie krótkiego opisu lub z treści
     */
    public function getExcerptOrContentAttribute(): string
    {
        if (!empty($this->excerpt)) {
            return $this->excerpt;
        }

        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Route model binding przez slug
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
