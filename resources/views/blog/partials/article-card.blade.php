<article class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col">
    @if($post->featured_image)
        <div class="h-48 overflow-hidden">
            <img src="{{ $post->featured_image_url }}"
                 alt="{{ $post->title }}"
                 class="w-full h-full object-cover">
        </div>
    @endif

    <div class="p-4 flex-1 flex flex-col">
        <div class="flex-1">
            <h2 class="text-lg font-bold mb-2 line-clamp-2">
                <a href="{{ route('blog.show', $post) }}"
                   class="text-gray-900 hover:text-blue-600 transition-colors">
                    {{ $post->title }}
                    @if($post->is_password_protected)
                        <span class="text-sm text-yellow-600 ml-1">🔒</span>
                    @endif
                </a>
            </h2>

            @if($post->excerpt)
                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $post->excerpt }}</p>
            @endif
        </div>

        <div class="mt-auto">
            <!-- Meta informacje -->
            <div class="text-xs text-gray-500 mb-3">
                <div class="flex items-center justify-between">
                    <span>{{ $post->author->name }}</span>
                    <span>{{ $post->views_count }} wyświetleń</span>
                </div>
                <div class="mt-1">
                    {{ $post->published_at ? $post->published_at->format('d.m.Y') : $post->created_at->format('d.m.Y') }}
                </div>
            </div>

            <a href="{{ route('blog.show', $post) }}"
               class="inline-block bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-blue-700 transition-colors w-full text-center">
                Czytaj dalej →
            </a>
        </div>
    </div>
</article>