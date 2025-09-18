<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Testy funkcjonalności systemu blogów
 * Zgodnie z TDD - testy przed implementacją
 */
class BlogPostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;
    protected $user;

    /**
     * Przygotowanie danych testowych
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Tworzenie użytkowników testowych z uprawnieniami admin
        $this->admin = User::factory()->create([
            'email' => 'admin@test.com',
            'is_admin' => true // Ustawienie jako admin aby ominąć middleware admin
        ]);
        $this->user = User::factory()->create(['email' => 'user@test.com']);

        // Ustawienie storage dla testów
        Storage::fake('public');
    }

    /**
     * Test: Admin może wyświetlić listę wszystkich artykułów
     */
    public function test_admin_can_view_blog_posts_index(): void
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/blog');

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog.index');
    }

    /**
     * Test: Admin może wyświetlić formularz tworzenia artykułu
     */
    public function test_admin_can_view_create_blog_post_form(): void
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/blog/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog.create');
    }

    /**
     * Test: Admin może utworzyć nowy artykuł (scenariusz pozytywny)
     */
    public function test_admin_can_create_blog_post_successfully(): void
    {
        $this->actingAs($this->admin);

        $blogData = [
            'title' => 'Test Artykuł',
            'excerpt' => 'Krótki opis testowego artykułu',
            'content' => 'Treść testowego artykułu dla systemu blogów',
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'published_at' => now()->format('Y-m-d H:i:s'),
            'meta_title' => 'Meta tytuł',
            'meta_description' => 'Meta opis',
            'meta_keywords' => ['test', 'artykul', 'blog']
        ];

        $response = $this->post('/admin/blog', $blogData);

        $response->assertRedirect();
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test Artykuł',
            'slug' => 'test-artykul',
            'status' => BlogPost::STATUS_PUBLISHED,
            'author_id' => $this->admin->id,
        ]);
    }

    /**
     * Test: Walidacja podczas tworzenia artykułu (scenariusz negatywny)
     */
    public function test_create_blog_post_validation_fails(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post('/admin/blog', []);

        $response->assertSessionHasErrors(['title', 'content']);
    }

    /**
     * Test: Admin może wyświetlić szczegóły artykułu
     */
    public function test_admin_can_view_blog_post_details(): void
    {
        $this->actingAs($this->admin);
        $blogPost = BlogPost::factory()->create(['author_id' => $this->admin->id]);

        $response = $this->get('/admin/blog/' . $blogPost->id);

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog.show');
        $response->assertViewHas('blogPost', $blogPost);
    }

    /**
     * Test: Admin może edytować artykuł
     */
    public function test_admin_can_edit_blog_post(): void
    {
        $this->actingAs($this->admin);
        $blogPost = BlogPost::factory()->create(['author_id' => $this->admin->id]);

        $updateData = [
            'title' => 'Zaktualizowany Tytuł',
            'slug' => 'zaktualizowany-tytul',
            'content' => 'Zaktualizowana treść',
            'status' => BlogPost::STATUS_ARCHIVED
        ];

        $response = $this->put('/admin/blog/' . $blogPost->id, $updateData);

        $response->assertRedirect();
        $this->assertDatabaseHas('blog_posts', [
            'id' => $blogPost->id,
            'title' => 'Zaktualizowany Tytuł',
            'status' => BlogPost::STATUS_ARCHIVED
        ]);
    }

    /**
     * Test: Admin może usunąć artykuł (soft delete)
     */
    public function test_admin_can_delete_blog_post(): void
    {
        $this->actingAs($this->admin);
        $blogPost = BlogPost::factory()->create(['author_id' => $this->admin->id]);

        $response = $this->delete('/admin/blog/' . $blogPost->id);

        $response->assertRedirect();
        $this->assertSoftDeleted('blog_posts', ['id' => $blogPost->id]);
    }

    /**
     * Test: Admin może przywrócić usunięty artykuł
     */
    public function test_admin_can_restore_deleted_blog_post(): void
    {
        $this->actingAs($this->admin);
        $blogPost = BlogPost::factory()->create(['author_id' => $this->admin->id]);
        $blogPost->delete();

        $response = $this->patch('/admin/blog/' . $blogPost->id . '/restore');

        $response->assertRedirect();
        $this->assertDatabaseHas('blog_posts', [
            'id' => $blogPost->id,
            'deleted_at' => null
        ]);
    }

    /**
     * Test: Upload zdjęcia do artykułu
     */
    public function test_admin_can_upload_featured_image(): void
    {
        $this->actingAs($this->admin);
        $file = UploadedFile::fake()->create('test-image.jpg', 1024, 'image/jpeg');

        $blogData = [
            'title' => 'Artykuł z obrazem',
            'slug' => 'artykul-z-obrazem',
            'content' => 'Treść artykułu',
            'featured_image' => $file,
            'status' => BlogPost::STATUS_PUBLISHED,
        ];

        $response = $this->post('/admin/blog', $blogData);

        $response->assertRedirect();
        Storage::disk('public')->assertExists('blog/' . $file->hashName());
    }

    /**
     * Test: Artykuł z hasłem jest chroniony
     */
    public function test_blog_post_with_password_is_protected(): void
    {
        $this->actingAs($this->admin);

        $blogData = [
            'title' => 'Chroniony Artykuł',
            'content' => 'Treść chroniona',
            'password' => 'secret123',
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true
        ];

        $response = $this->post('/admin/blog', $blogData);

        $blogPost = BlogPost::where('title', 'Chroniony Artykuł')->first();
        $this->assertTrue($blogPost->is_password_protected);
        $this->assertTrue($blogPost->checkPassword('secret123'));
        $this->assertFalse($blogPost->checkPassword('wrong'));
    }

    /**
     * Test: Publiczny listing blogów
     */
    public function test_public_blog_listing_shows_published_posts(): void
    {
        $publishedPost = BlogPost::factory()->create([
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'author_id' => $this->admin->id
        ]);

        $draftPost = BlogPost::factory()->create([
            'status' => BlogPost::STATUS_DRAFT,
            'author_id' => $this->admin->id
        ]);

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertViewIs('blog.index');
        $response->assertSee($publishedPost->title);
        $response->assertDontSee($draftPost->title);
    }

    /**
     * Test: Wyświetlenie pojedynczego wpisu publicznego
     */
    public function test_public_blog_post_view(): void
    {
        $blogPost = BlogPost::factory()->create([
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'author_id' => $this->admin->id
        ]);

        $response = $this->get('/blog/' . $blogPost->slug);

        $response->assertStatus(200);
        $response->assertViewIs('blog.show');
        $response->assertSee($blogPost->title);
        $response->assertSee($blogPost->content);
    }

    /**
     * Test: Artykuł chroniony hasłem wymaga autoryzacji
     */
    public function test_password_protected_post_requires_password(): void
    {
        $blogPost = BlogPost::factory()->create([
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'password' => 'secret123',
            'is_password_protected' => true,
            'author_id' => $this->admin->id
        ]);

        $response = $this->get('/blog/' . $blogPost->slug);

        $response->assertStatus(200);
        $response->assertViewIs('blog.password-form');
    }

    /**
     * Test: Prawidłowe hasło umożliwia dostęp do chronionego artykułu
     */
    public function test_correct_password_grants_access_to_protected_post(): void
    {
        $blogPost = BlogPost::factory()->create([
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'password' => 'secret123',
            'is_password_protected' => true,
            'author_id' => $this->admin->id
        ]);

        $response = $this->post('/blog/' . $blogPost->slug . '/password', [
            'password' => 'secret123'
        ]);

        $response->assertRedirect('/blog/' . $blogPost->slug);
        $response->assertSessionHas('blog_post_access.' . $blogPost->id);
    }

    /**
     * Test: Nieprawidłowe hasło blokuje dostęp
     */
    public function test_incorrect_password_denies_access(): void
    {
        $blogPost = BlogPost::factory()->create([
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'password' => 'secret123',
            'is_password_protected' => true,
            'author_id' => $this->admin->id
        ]);

        $response = $this->post('/blog/' . $blogPost->slug . '/password', [
            'password' => 'wrong'
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test: Licznik wyświetleń jest inkrementowany
     */
    public function test_views_counter_is_incremented(): void
    {
        $blogPost = BlogPost::factory()->create([
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'views_count' => 0,
            'author_id' => $this->admin->id
        ]);

        $this->get('/blog/' . $blogPost->slug);

        $blogPost->refresh();
        $this->assertEquals(1, $blogPost->views_count);
    }
}
