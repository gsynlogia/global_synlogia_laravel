@extends('layouts.admin')

@section('title', 'Edycja: ' . $blogPost->title . ' - Global Synlogia')
@section('page-title', 'Edycja artykułu')
@section('page-description', 'Edytowanie wpisu blogowego')

@section('content')
<form method="POST" action="{{ route('admin.blog.update', $blogPost->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Title and Slug -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Podstawowe informacje</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tytuł artykułu *</label>
                        <input type="text" name="title" value="{{ old('title', $blogPost->title) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('title') border-red-500 @enderror"
                               required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug URL *</label>
                        <input type="text" name="slug" value="{{ old('slug', $blogPost->slug) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('slug') border-red-500 @enderror"
                               required>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Podgląd URL -->
                        <div class="mt-2 p-2 bg-gray-50 border border-gray-200 rounded-lg">
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex-1 min-w-0">
                                    <span class="text-xs text-gray-600 block mb-1">Podgląd URL:</span>
                                    @if($blogPost->isPubliclyAccessible())
                                        <a href="{{ route('blog.show', $blogPost) }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800 text-xs break-all">
                                            {{ route('blog.show', $blogPost) }}
                                        </a>
                                    @else
                                        <span class="text-gray-500 text-xs break-all">
                                            {{ route('blog.show', $blogPost) }}
                                        </span>
                                        <p class="text-red-600 text-xs mt-1">Artykuł nie jest publicznie dostępny</p>
                                    @endif
                                </div>
                                @if($blogPost->isPubliclyAccessible())
                                    <a href="{{ route('blog.show', $blogPost) }}" target="_blank"
                                       class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-xs font-medium flex-shrink-0">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        Otwórz
                                    </a>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-500 rounded text-xs font-medium flex-shrink-0">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        Nieaktywny
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Krótki opis</label>
                        <textarea name="excerpt" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('excerpt') border-red-500 @enderror"
                                  placeholder="Opcjonalny krótki opis artykułu">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Treść artykułu</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Treść *</label>

                    <x-synlogia-editor
                        name="content"
                        :value="old('content', $blogPost->content)"
                        placeholder="Napisz treść artykułu..."
                        :height="400"
                        class="@error('content') border-red-500 @enderror"
                    />

                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Publishing Options -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Publikacja</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" {{ old('status', $blogPost->status) == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_enabled" id="is_enabled" value="1"
                               {{ old('is_enabled', $blogPost->is_enabled) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:border-blue-300 focus:ring focus:ring-blue-200">
                        <label for="is_enabled" class="ml-2 text-sm text-gray-700">Artykuł włączony</label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data publikacji</label>
                        <input type="datetime-local" name="published_at"
                               value="{{ old('published_at', $blogPost->published_at ? $blogPost->published_at->format('Y-m-d\TH:i') : '') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data zakończenia publikacji</label>
                        <input type="datetime-local" name="published_until"
                               value="{{ old('published_until', $blogPost->published_until ? $blogPost->published_until->format('Y-m-d\TH:i') : '') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">Pozostaw puste dla publikacji bez ograniczeń czasowych</p>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Główne zdjęcie</h3>

                @if($blogPost->featured_image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Aktualne zdjęcie:</p>
                        <img src="{{ $blogPost->featured_image_url }}" alt=""
                             class="w-full h-32 object-cover rounded-lg mb-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="remove_featured_image" id="remove_featured_image" value="1"
                                   class="rounded border-gray-300 text-red-600">
                            <label for="remove_featured_image" class="ml-2 text-sm text-red-600">Usuń obecne zdjęcie</label>
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload nowego pliku</label>
                        <input type="file" name="featured_image" accept="image/*"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">Max 2MB, formaty: JPG, PNG, GIF</p>
                    </div>

                    <div class="text-center text-gray-500">LUB</div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL zewnętrznego zdjęcia</label>
                        <input type="url" name="featured_image_url"
                               value="{{ old('featured_image_url', $blogPost->featured_image_is_url ? $blogPost->featured_image : '') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2"
                               placeholder="https://example.com/image.jpg">
                    </div>
                </div>
            </div>

            <!-- Password Protection -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ochrona hasłem</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hasło dostępu</label>

                    @if($blogPost->is_password_protected)
                        <!-- Show current password in editable state -->
                        <div class="mb-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <span class="text-sm font-medium text-yellow-800 block mb-1">🔒 Aktualnie chroniony hasłem:</span>
                                    <code id="current-password" class="px-2 py-1 bg-yellow-100 text-yellow-900 rounded font-mono text-sm break-all word-wrap">●●●●●●●●</code>
                                </div>
                                <button type="button" onclick="togglePasswordVisibility()" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium flex-shrink-0">
                                    <span id="toggle-text">Pokaż</span>
                                </button>
                            </div>
                        </div>

                        <script>
                        function togglePasswordVisibility() {
                            const passwordSpan = document.getElementById('current-password');
                            const toggleText = document.getElementById('toggle-text');

                            if (passwordSpan.textContent === '●●●●●●●●') {
                                passwordSpan.textContent = '{{ $blogPost->password }}';
                                toggleText.textContent = 'Ukryj';
                            } else {
                                passwordSpan.textContent = '●●●●●●●●';
                                toggleText.textContent = 'Pokaż';
                            }
                        }
                        </script>
                    @endif

                    <input type="password" name="password"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2"
                           placeholder="{{ $blogPost->is_password_protected ? 'Wpisz nowe hasło aby zmienić (lub zostaw puste)' : 'Pozostaw puste dla dostępu publicznego' }}">
                    <p class="text-xs text-gray-500 mt-1">
                        @if($blogPost->is_password_protected)
                            Pozostaw puste aby zachować obecne hasło, lub wpisz nowe aby zmienić
                        @else
                            Minimum 6 znaków - wpisz hasło aby chronić artykuł
                        @endif
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 admin-button text-white px-4 py-2 rounded-lg font-medium">
                        Zapisz zmiany
                    </button>
                    <a href="{{ route('admin.blog.show', $blogPost->id) }}"
                       class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium text-center hover:bg-gray-50">
                        Anuluj
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection