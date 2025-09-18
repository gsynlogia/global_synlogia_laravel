<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

/**
 * Kontroler administracyjny do zarządzania wpisami blogowymi
 */
class BlogController extends Controller
{
    /**
     * Wyświetlenie listy wszystkich artykułów
     */
    public function index(Request $request)
    {
        $query = BlogPost::with('author')->withTrashed();

        // Filtrowanie po statusie
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtrowanie po autorze
        if ($request->filled('author')) {
            $query->where('author_id', $request->author);
        }

        // Filtrowanie chronionych hasłem
        if ($request->filled('password_protected')) {
            if ($request->password_protected === 'yes') {
                $query->where('is_password_protected', true);
            } elseif ($request->password_protected === 'no') {
                $query->where('is_password_protected', false);
            }
        }

        // Filtrowanie po dacie publikacji
        if ($request->filled('date_from')) {
            $query->where('published_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('published_at', '<=', $request->date_to . ' 23:59:59');
        }

        // Wyszukiwanie po tytule i treści
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        // Sortowanie
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSorts = ['created_at', 'published_at', 'title', 'views_count', 'status'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->latest();
        }

        // Paginacja - 20 na stronę
        $blogPosts = $query->paginate(20);
        $blogPosts->appends(request()->query());

        // Dane dla filtrów
        $statuses = BlogPost::getStatuses();
        $authors = \App\Models\User::where('is_admin', true)->get();

        return view('admin.blog.index', compact('blogPosts', 'statuses', 'authors'));
    }

    /**
     * Wyświetlenie formularza tworzenia nowego artykułu
     */
    public function create()
    {
        $statuses = BlogPost::getStatuses();

        return view('admin.blog.create', compact('statuses'));
    }

    /**
     * Zapisanie nowego artykułu do bazy danych
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048', // Max 2MB
            'featured_image_url' => 'nullable|url',
            'status' => 'required|in:draft,published,archived',
            'is_enabled' => 'boolean',
            'published_at' => 'nullable|date',
            'published_until' => 'nullable|date|after:published_at',
            'password' => 'nullable|string|min:6',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|array',
        ]);

        // Generowanie slug jeśli nie podano
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Obsługa głównego zdjęcia
        $this->handleFeaturedImage($request, $validated);

        // Ustawienie autora
        $validated['author_id'] = auth()->id();

        // Obsługa dat
        if (empty($validated['published_at']) && $validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $blogPost = BlogPost::create($validated);

        return redirect()->route('admin.admin.blog.show', $blogPost)
                        ->with('success', 'Artykuł został utworzony pomyślnie!');
    }

    /**
     * Wyświetlenie szczegółów artykułu
     */
    public function show($id)
    {
        $blogPost = BlogPost::with('author')->findOrFail($id);

        return view('admin.blog.show', compact('blogPost'));
    }

    /**
     * Wyświetlenie formularza edycji artykułu
     */
    public function edit($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $statuses = BlogPost::getStatuses();

        return view('admin.blog.edit', compact('blogPost', 'statuses'));
    }

    /**
     * Aktualizacja artykułu
     */
    public function update(Request $request, $id)
    {
        $blogPost = BlogPost::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_posts,slug,' . $blogPost->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'featured_image_url' => 'nullable|url',
            'remove_featured_image' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'is_enabled' => 'boolean',
            'published_at' => 'nullable|date',
            'published_until' => 'nullable|date|after:published_at',
            'password' => 'nullable|string|min:6',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|array',
        ]);

        // Usunięcie głównego zdjęcia jeśli zaznaczono
        if ($request->has('remove_featured_image')) {
            $this->removeFeaturedImage($blogPost);
            $validated['featured_image'] = null;
            $validated['featured_image_is_url'] = false;
        }

        // Obsługa nowego głównego zdjęcia
        $this->handleFeaturedImage($request, $validated);

        // Obsługa dat publikacji
        if (empty($validated['published_at']) && $validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $blogPost->update($validated);

        return redirect()->route('admin.admin.blog.show', $blogPost)
                        ->with('success', 'Artykuł został zaktualizowany pomyślnie!');
    }

    /**
     * Usunięcie artykułu (soft delete)
     */
    public function destroy($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $blogPost->delete();

        return redirect()->route('admin.admin.blog.index')
                        ->with('success', 'Artykuł został przeniesiony do kosza.');
    }

    /**
     * Przywrócenie usuniętego artykułu
     */
    public function restore($id)
    {
        $blogPost = BlogPost::withTrashed()->findOrFail($id);
        $blogPost->restore();

        return redirect()->route('admin.admin.blog.index')
                        ->with('success', 'Artykuł został przywrócony.');
    }

    /**
     * Obsługa uploadu głównego zdjęcia
     */
    private function handleFeaturedImage(Request $request, array &$validated)
    {
        // Jeśli przesłano plik zdjęcia
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $path = $file->store('blog', 'public');

            $validated['featured_image'] = $path;
            $validated['featured_image_is_url'] = false;
        }
        // Jeśli podano URL zewnętrznego zdjęcia
        elseif ($request->filled('featured_image_url')) {
            $validated['featured_image'] = $request->featured_image_url;
            $validated['featured_image_is_url'] = true;
        }
    }

    /**
     * Usunięcie głównego zdjęcia z storage
     */
    private function removeFeaturedImage(BlogPost $blogPost)
    {
        if ($blogPost->featured_image && !$blogPost->featured_image_is_url) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }
    }
}