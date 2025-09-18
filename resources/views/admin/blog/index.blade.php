@extends('layouts.admin')

@section('title', 'Zarządzanie blogiem - Global Synlogia')
@section('page-title', 'Blog')
@section('page-description', 'Zarządzanie wpisami blogowymi')

@section('content')
<div class="bg-white rounded-xl border border-gray-100 p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">Artykuły blogowe</h3>
        <a href="{{ route('admin.blog.create') }}" class="admin-button text-white px-4 py-2 rounded-lg font-medium">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Nowy artykuł
        </a>
    </div>

    <!-- Collapsible Advanced Filtering -->
    <div class="mb-6 bg-gray-50 rounded-lg">
        <!-- Filter Toggle Button -->
        <div class="p-4 border-b border-gray-200">
            <button type="button" onclick="toggleFilters()" class="flex items-center justify-between w-full text-left">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"/>
                    </svg>
                    <span class="font-medium text-gray-700">Filtry i wyszukiwanie</span>
                    @if(request()->hasAny(['status', 'author', 'password_protected', 'search', 'date_from', 'date_to', 'sort_by']))
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Aktywne</span>
                    @endif
                </div>
                <svg id="filter-arrow" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>

        <!-- Collapsible Filter Content -->
        <div id="filter-content" class="hidden p-4">
            <form method="GET" class="space-y-4">
            <!-- Pierwsza linia filtrów -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Wszystkie statusy</option>
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Autor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                    <select name="author" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Wszyscy autorzy</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Chronione hasłem -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Chronione hasłem</label>
                    <select name="password_protected" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Wszystkie</option>
                        <option value="yes" {{ request('password_protected') == 'yes' ? 'selected' : '' }}>Tak</option>
                        <option value="no" {{ request('password_protected') == 'no' ? 'selected' : '' }}>Nie</option>
                    </select>
                </div>

                <!-- Sortowanie -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sortuj według</label>
                    <div class="flex space-x-2">
                        <select name="sort_by" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Data utworzenia</option>
                            <option value="published_at" {{ request('sort_by') == 'published_at' ? 'selected' : '' }}>Data publikacji</option>
                            <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Tytuł</option>
                            <option value="views_count" {{ request('sort_by') == 'views_count' ? 'selected' : '' }}>Wyświetlenia</option>
                        </select>
                        <select name="sort_order" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>↓</option>
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>↑</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Druga linia filtrów -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Wyszukiwanie -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Wyszukaj</label>
                    <input type="text" name="search" placeholder="Tytuł, treść lub excerpt..."
                           value="{{ request('search') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Data od -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Data publikacji od</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Data do -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Data publikacji do</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Przyciski akcji -->
            <div class="flex space-x-3">
                <button type="submit" class="admin-button text-white px-6 py-2 rounded-lg font-medium">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Filtruj
                </button>
                <a href="{{ route('admin.blog.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Wyczyść
                </a>
            </div>
            </form>
        </div>
    </div>

    <!-- Results Info -->
    <div class="mb-4 flex justify-between items-center text-sm text-gray-600">
        <div>
            Pokazano <strong>{{ $blogPosts->firstItem() ?? 0 }}</strong> - <strong>{{ $blogPosts->lastItem() ?? 0 }}</strong>
            z <strong>{{ $blogPosts->total() }}</strong> artykułów
            @if(request()->hasAny(['status', 'author', 'password_protected', 'search', 'date_from', 'date_to']))
                <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">Filtrowane</span>
            @endif
        </div>
        <div>
            <strong>{{ $blogPosts->perPage() }}</strong> na stronę
        </div>
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
                                <a href="{{ route('admin.blog.show', $post->id) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    Podgląd
                                </a>
                                <a href="{{ route('admin.blog.edit', $post->id) }}"
                                   class="text-green-600 hover:text-green-800">
                                    Edytuj
                                </a>
                                @if($post->trashed())
                                    <form method="POST" action="{{ route('admin.blog.restore', $post->id) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-800">
                                            Przywróć
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.blog.destroy', $post->id) }}" class="inline">
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
            <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                <div class="flex flex-1 justify-between sm:hidden">
                    @if($blogPosts->onFirstPage())
                        <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500">Poprzednia</span>
                    @else
                        <a href="{{ $blogPosts->appends(request()->query())->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Poprzednia</a>
                    @endif

                    @if($blogPosts->hasMorePages())
                        <a href="{{ $blogPosts->appends(request()->query())->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Następna</a>
                    @else
                        <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500">Następna</span>
                    @endif
                </div>

                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Pokazano <span class="font-medium">{{ $blogPosts->firstItem() }}</span> do <span class="font-medium">{{ $blogPosts->lastItem() }}</span>
                            z <span class="font-medium">{{ $blogPosts->total() }}</span> wyników
                        </p>
                    </div>
                    <div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            {{-- Previous Page Link --}}
                            @if($blogPosts->onFirstPage())
                                <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $blogPosts->appends(request()->query())->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                $currentPage = $blogPosts->currentPage();
                                $lastPage = $blogPosts->lastPage();
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($lastPage, $currentPage + 2);
                            @endphp

                            @if($startPage > 1)
                                <a href="{{ $blogPosts->appends(request()->query())->url(1) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">1</a>
                                @if($startPage > 2)
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                                @endif
                            @endif

                            @for($i = $startPage; $i <= $endPage; $i++)
                                @if($i == $currentPage)
                                    <span class="relative z-10 inline-flex items-center bg-blue-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{ $i }}</span>
                                @else
                                    <a href="{{ $blogPosts->appends(request()->query())->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{ $i }}</a>
                                @endif
                            @endfor

                            @if($endPage < $lastPage)
                                @if($endPage < $lastPage - 1)
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                                @endif
                                <a href="{{ $blogPosts->appends(request()->query())->url($lastPage) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{ $lastPage }}</a>
                            @endif

                            {{-- Next Page Link --}}
                            @if($blogPosts->hasMorePages())
                                <a href="{{ $blogPosts->appends(request()->query())->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            </nav>
        </div>
    @endif
</div>

<script>
function toggleFilters() {
    const content = document.getElementById('filter-content');
    const arrow = document.getElementById('filter-arrow');

    if (content.classList.contains('hidden')) {
        // Show filters
        content.classList.remove('hidden');
        content.style.animation = 'slideDown 0.3s ease-out';
        arrow.style.transform = 'rotate(180deg)';
    } else {
        // Hide filters
        content.style.animation = 'slideUp 0.3s ease-out';
        setTimeout(() => {
            content.classList.add('hidden');
        }, 250);
        arrow.style.transform = 'rotate(0deg)';
    }
}

// Auto-expand if filters are active
document.addEventListener('DOMContentLoaded', function() {
    @if(request()->hasAny(['status', 'author', 'password_protected', 'search', 'date_from', 'date_to', 'sort_by']))
        toggleFilters();
    @endif
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection