@extends('layouts.app')

@section('title', $blogPost->title . ' - Global Synlogia')

@section('meta')
    @if($blogPost->meta_description)
        <meta name="description" content="{{ $blogPost->meta_description }}">
    @endif
    @if($blogPost->meta_keywords)
        <meta name="keywords" content="{{ implode(', ', $blogPost->meta_keywords) }}">
    @endif
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Navigation -->
        <div class="mb-6">
            <a href="{{ route('blog.index') }}"
               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                ← Powrót do bloga
            </a>
        </div>

        <!-- Article -->
        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($blogPost->featured_image)
                <div class="h-96 overflow-hidden">
                    <img src="{{ $blogPost->featured_image_url }}"
                         alt="{{ $blogPost->title }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <!-- Header -->
                <header class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        {{ $blogPost->title }}
                        @if($blogPost->is_password_protected)
                            <span class="text-lg text-yellow-600 ml-2">🔒</span>
                        @endif
                    </h1>

                    @if($blogPost->excerpt)
                        <p class="text-xl text-gray-600 mb-6 leading-relaxed">{{ $blogPost->excerpt }}</p>
                    @endif

                    <div class="flex items-center space-x-6 text-sm text-gray-500 border-b border-gray-200 pb-6">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $blogPost->author->name }}</span>
                        </div>
                        <div>
                            @if($blogPost->published_at)
                                <time datetime="{{ $blogPost->published_at->toISOString() }}">
                                    {{ $blogPost->published_at->format('d.m.Y H:i') }}
                                </time>
                            @else
                                <span>{{ $blogPost->created_at->format('d.m.Y H:i') }}</span>
                            @endif
                        </div>
                        <div>
                            {{ $blogPost->views_count }} wyświetleń
                        </div>
                    </div>
                </header>

                <!-- Content -->
                <div class="prose prose-lg max-w-none">
                    {!! nl2br($blogPost->content) !!}
                </div>

                <!-- Footer -->
                <footer class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            @if($blogPost->published_at)
                                Opublikowano: {{ $blogPost->published_at->format('d.m.Y H:i') }}
                            @else
                                Utworzono: {{ $blogPost->created_at->format('d.m.Y H:i') }}
                            @endif
                            @if($blogPost->updated_at->gt($blogPost->created_at))
                                <br>Zaktualizowano: {{ $blogPost->updated_at->format('d.m.Y H:i') }}
                            @endif
                        </div>

                        <div class="flex space-x-4">
                            <a href="{{ route('blog.index') }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Więcej artykułów
                            </a>
                        </div>
                    </div>
                </footer>
            </div>
        </article>
    </div>
</div>
@endsection