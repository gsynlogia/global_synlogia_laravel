@extends('layouts.app')

@section('title', 'Blog - Global Synlogia')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Blog</h1>
            <p class="text-gray-600">Najnowsze artykuły i aktualności</p>
        </div>

        <!-- Grid layout z 3 artykułami w rzędzie -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="articles-grid">
            @forelse($blogPosts as $post)
                @include('blog.partials.article-card', ['post' => $post])
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Brak artykułów</h3>
                    <p class="text-gray-600">Wkrótce pojawią się tutaj nowe wpisy</p>
                </div>
            @endforelse
        </div>

        <!-- Loading indicator dla infinite scroll -->
        <div id="loading" class="hidden text-center py-8">
            <div class="inline-flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Ładowanie kolejnych artykułów...
            </div>
        </div>

        <!-- Komunikat o końcu artykułów -->
        <div id="no-more-posts" class="hidden text-center py-8">
            <p class="text-gray-500">To wszystkie dostępne artykuły</p>
        </div>
    </div>
</div>

<!-- Infinite Scroll JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    let isLoading = false;
    let hasMorePages = {{ $blogPosts->hasMorePages() ? 'true' : 'false' }};

    const articlesContainer = document.getElementById('articles-grid');
    const loadingIndicator = document.getElementById('loading');
    const noMorePostsIndicator = document.getElementById('no-more-posts');

    // Funkcja ładowania kolejnych artykułów
    async function loadMorePosts() {
        if (isLoading || !hasMorePages) return;

        isLoading = true;
        loadingIndicator.classList.remove('hidden');

        try {
            const response = await fetch(`{{ route('blog.index') }}?page=${currentPage + 1}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();

            if (data.html && data.html.trim()) {
                // Dodanie nowych artykułów do kontenera
                articlesContainer.insertAdjacentHTML('beforeend', data.html);
                currentPage++;
                hasMorePages = data.hasMorePages;

                if (!hasMorePages) {
                    noMorePostsIndicator.classList.remove('hidden');
                }
            } else {
                hasMorePages = false;
                noMorePostsIndicator.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error loading more posts:', error);
            // Pokaż błąd użytkownikowi
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-center py-4 text-red-600';
            errorDiv.textContent = 'Błąd podczas ładowania artykułów. Spróbuj ponownie.';
            articlesContainer.insertAdjacentElement('afterend', errorDiv);
        } finally {
            isLoading = false;
            loadingIndicator.classList.add('hidden');
        }
    }

    // Infinite scroll listener
    function handleScroll() {
        const scrollPosition = window.innerHeight + window.scrollY;
        const documentHeight = document.documentElement.scrollHeight;
        const threshold = 1000; // Ładuj gdy zostało 1000px do końca

        if (scrollPosition >= documentHeight - threshold) {
            loadMorePosts();
        }
    }

    // Dodanie event listenera
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Opcjonalnie: ładowanie przy kliknięciu w loading indicator
    loadingIndicator.addEventListener('click', loadMorePosts);
});
</script>
@endsection