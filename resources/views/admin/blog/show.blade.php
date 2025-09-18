@extends('layouts.admin')

@section('title', $blogPost->title . ' - Global Synlogia')
@section('page-title', 'Podgląd artykułu')
@section('page-description', 'Szczegóły wpisu blogowego')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Article Content -->
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $blogPost->title }}</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.admin.blog.edit', $blogPost->id) }}"
                       class="admin-button text-white px-4 py-2 rounded-lg font-medium">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edytuj
                    </a>
                    <a href="{{ route('admin.admin.blog.index') }}"
                       class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-50">
                        Powrót do listy
                    </a>
                </div>
            </div>

            @if($blogPost->featured_image)
                <div class="mb-6">
                    <img src="{{ $blogPost->featured_image_url }}" alt="{{ $blogPost->title }}"
                         class="w-full h-64 object-cover rounded-lg">
                </div>
            @endif

            @if($blogPost->excerpt)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-700 mb-2">Krótki opis:</h3>
                    <p class="text-gray-600">{{ $blogPost->excerpt }}</p>
                </div>
            @endif

            <div class="prose max-w-none">
                {!! nl2br(e($blogPost->content)) !!}
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Article Info -->
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Informacje o artykule</h3>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Status:</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                        @if($blogPost->status === 'published') bg-green-100 text-green-800
                        @elseif($blogPost->status === 'draft') bg-gray-100 text-gray-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ \App\Models\BlogPost::getStatuses()[$blogPost->status] }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Włączony:</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                        {{ $blogPost->is_enabled ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $blogPost->is_enabled ? 'Tak' : 'Nie' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Autor:</span>
                    <span class="font-medium">{{ $blogPost->author->name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Utworzony:</span>
                    <span>{{ $blogPost->created_at->format('d.m.Y H:i') }}</span>
                </div>

                @if($blogPost->published_at)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Publikacja:</span>
                        <span>{{ $blogPost->published_at->format('d.m.Y H:i') }}</span>
                    </div>
                @endif

                @if($blogPost->published_until)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Koniec publikacji:</span>
                        <span>{{ $blogPost->published_until->format('d.m.Y H:i') }}</span>
                    </div>
                @endif

                <div class="flex justify-between">
                    <span class="text-gray-600">Wyświetlenia:</span>
                    <span class="font-medium">{{ $blogPost->views_count }}</span>
                </div>

                @if($blogPost->is_password_protected)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Chroniony hasłem:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            🔒 Tak
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- SEO Info -->
        @if($blogPost->meta_title || $blogPost->meta_description || $blogPost->meta_keywords)
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">SEO</h3>

                <div class="space-y-3 text-sm">
                    @if($blogPost->meta_title)
                        <div>
                            <span class="text-gray-600 block">Meta tytuł:</span>
                            <span class="font-medium">{{ $blogPost->meta_title }}</span>
                        </div>
                    @endif

                    @if($blogPost->meta_description)
                        <div>
                            <span class="text-gray-600 block">Meta opis:</span>
                            <span>{{ $blogPost->meta_description }}</span>
                        </div>
                    @endif

                    @if($blogPost->meta_keywords)
                        <div>
                            <span class="text-gray-600 block">Słowa kluczowe:</span>
                            <div class="flex flex-wrap gap-1 mt-1">
                                @foreach($blogPost->meta_keywords as $keyword)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $keyword }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- URL Preview -->
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Podgląd URL</h3>

            <div class="space-y-2 text-sm">
                <div>
                    <span class="text-gray-600">Slug:</span>
                    <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $blogPost->slug }}</code>
                </div>

                @if($blogPost->isPubliclyAccessible())
                    <div>
                        <span class="text-gray-600">Publiczny link:</span>
                        <a href="{{ route('blog.show', $blogPost) }}" target="_blank"
                           class="text-blue-600 hover:text-blue-800 break-all">
                            {{ route('blog.show', $blogPost) }}
                        </a>
                    </div>
                @else
                    <div class="text-red-600 text-xs">
                        Artykuł nie jest publicznie dostępny
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection