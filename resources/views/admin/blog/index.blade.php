@extends('layouts.admin')

@section('title', 'Zarządzanie blogiem - Global Synlogia')
@section('page-title', 'Blog')
@section('page-description', 'Zarządzanie wpisami blogowymi')

@section('content')
<div class="bg-white rounded-xl border border-gray-100 p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">Artykuły blogowe</h3>
        <a href="{{ route('admin.admin.blog.create') }}" class="admin-button text-white px-4 py-2 rounded-lg font-medium">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Nowy artykuł
        </a>
    </div>

    <!-- Filtering -->
    <div class="mb-6 flex space-x-4">
        <form method="GET" class="flex space-x-4">
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2">
                <option value="">Wszystkie statusy</option>
                @foreach($statuses as $key => $label)
                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="search" placeholder="Szukaj po tytule..."
                   value="{{ request('search') }}"
                   class="border border-gray-300 rounded-lg px-3 py-2">
            <button type="submit" class="admin-button text-white px-4 py-2 rounded-lg">
                Filtruj
            </button>
        </form>
    </div>

    <!-- Blog Posts Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Tytuł</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Autor</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Data</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogPosts as $post)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                @if($post->featured_image)
                                    <img src="{{ $post->featured_image_url }}" alt="" class="w-10 h-10 rounded object-cover">
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900">{{ $post->title }}</div>
                                    @if($post->is_password_protected)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            🔒 Chroniony
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-600">
                            {{ $post->author->name }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                @if($post->status === 'published') bg-green-100 text-green-800
                                @elseif($post->status === 'draft') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $statuses[$post->status] }}
                            </span>
                            @if(!$post->is_enabled)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 ml-1">
                                    Wyłączony
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-600">
                            {{ $post->created_at->format('d.m.Y H:i') }}
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.admin.blog.show', $post->id) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    Podgląd
                                </a>
                                <a href="{{ route('admin.admin.blog.edit', $post->id) }}"
                                   class="text-green-600 hover:text-green-800">
                                    Edytuj
                                </a>
                                @if($post->trashed())
                                    <form method="POST" action="{{ route('admin.admin.blog.restore', $post->id) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-800">
                                            Przywróć
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.admin.blog.destroy', $post->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Czy na pewno chcesz usunąć ten artykuł?')">
                                            Usuń
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-sm">Brak artykułów blogowych</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($blogPosts->hasPages())
        <div class="mt-6">
            {{ $blogPosts->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection