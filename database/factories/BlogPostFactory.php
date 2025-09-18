<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Factory do tworzenia testowych wpisów blogowych
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Model dla którego tworzona jest factory
     */
    protected $model = BlogPost::class;

    /**
     * Definicja domyślnego stanu modelu
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4, true);
        $content = $this->faker->paragraphs(5, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(2),
            'content' => $content,
            'featured_image' => null,
            'featured_image_is_url' => false,
            'status' => $this->faker->randomElement([
                BlogPost::STATUS_DRAFT,
                BlogPost::STATUS_PUBLISHED,
                BlogPost::STATUS_ARCHIVED
            ]),
            'is_enabled' => $this->faker->boolean(80), // 80% szans na true
            'published_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 month', 'now'),
            'published_until' => $this->faker->optional(0.2)->dateTimeBetween('now', '+6 months'),
            'password' => null,
            'is_password_protected' => false,
            'author_id' => User::factory(),
            'meta_title' => $this->faker->optional()->sentence(3),
            'meta_description' => $this->faker->optional()->paragraph(1),
            'meta_keywords' => $this->faker->optional()->randomElements([
                'laravel', 'php', 'blog', 'artykuł', 'technologia', 'programowanie'
            ], $this->faker->numberBetween(1, 4)),
            'views_count' => $this->faker->numberBetween(0, 1000),
        ];
    }

    /**
     * State dla opublikowanych artykułów
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * State dla szkiców
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BlogPost::STATUS_DRAFT,
            'published_at' => null,
        ]);
    }

    /**
     * State dla zarchiwizowanych artykułów
     */
    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BlogPost::STATUS_ARCHIVED,
        ]);
    }

    /**
     * State dla artykułów chronionych hasłem
     */
    public function passwordProtected(): static
    {
        return $this->state(fn (array $attributes) => [
            'password' => bcrypt('secret123'),
            'is_password_protected' => true,
        ]);
    }

    /**
     * State dla artykułów z głównym zdjęciem
     */
    public function withFeaturedImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured_image' => 'blog/featured-' . $this->faker->uuid() . '.jpg',
            'featured_image_is_url' => false,
        ]);
    }

    /**
     * State dla artykułów z zewnętrznym zdjęciem
     */
    public function withExternalImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured_image' => $this->faker->imageUrl(800, 600, 'technology'),
            'featured_image_is_url' => true,
        ]);
    }

    /**
     * State dla popularnych artykułów (dużo wyświetleń)
     */
    public function popular(): static
    {
        return $this->state(fn (array $attributes) => [
            'views_count' => $this->faker->numberBetween(1000, 10000),
        ]);
    }
}
