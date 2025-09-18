<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    /**
     * Wyświetlenie publicznej listy artykułów blogowych
     */
    public function index()
    {
        $blogPosts = BlogPost::published()
            ->enabled()
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        // Sprawdzenie czy to AJAX request dla infinite scroll
        if (request()->ajax()) {
            $html = '';

            foreach ($blogPosts as $post) {
                $html .= view('blog.partials.article-card', compact('post'))->render();
            }

            return response()->json([
                'html' => $html,
                'hasMorePages' => $blogPosts->hasMorePages(),
                'currentPage' => $blogPosts->currentPage(),
                'lastPage' => $blogPosts->lastPage()
            ]);
        }

        return view('blog.index', compact('blogPosts'));
    }

    /**
     * Wyświetlenie pojedynczego artykułu blogowego
     */
    public function show(BlogPost $blogPost)
    {
        // Sprawdzenie czy artykuł jest publicznie dostępny
        if (!$blogPost->isPubliclyAccessible()) {
            abort(404);
        }

        // Sprawdzenie ochrony hasłem
        if ($blogPost->is_password_protected) {
            if (!Session::has('blog_post_access.' . $blogPost->id)) {
                return view('blog.password-form', compact('blogPost'));
            }
        }

        // Inkrementacja licznika wyświetleń
        $blogPost->increment('views_count');

        return view('blog.show', compact('blogPost'));
    }

    /**
     * Weryfikacja hasła dla chronionego artykułu
     */
    public function checkPassword(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if ($blogPost->checkPassword($request->password)) {
            // Zapisanie dostępu w sesji
            Session::put('blog_post_access.' . $blogPost->id, true);
            return redirect()->route('blog.show', $blogPost);
        }

        return redirect()->back()->withErrors([
            'password' => 'Nieprawidłowe hasło'
        ]);
    }
}
