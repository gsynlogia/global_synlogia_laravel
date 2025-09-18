@extends('layouts.admin')

@section('title', 'Nowy artykuł - Global Synlogia')
@section('page-title', 'Nowy artykuł')
@section('page-description', 'Tworzenie nowego wpisu blogowego')

@section('content')
<form method="POST" action="{{ route('admin.admin.blog.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Title and Slug -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Podstawowe informacje</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tytuł artykułu *</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('title') border-red-500 @enderror"
                               required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug URL</label>
                        <input type="text" name="slug" value="{{ old('slug') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('slug') border-red-500 @enderror"
                               placeholder="Zostanie wygenerowany automatycznie">
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Krótki opis</label>
                        <textarea name="excerpt" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('excerpt') border-red-500 @enderror"
                                  placeholder="Opcjonalny krótki opis artykułu">{{ old('excerpt') }}</textarea>
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">Treść *</label>
                    <textarea name="content" rows="15"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('content') border-red-500 @enderror"
                              required>{{ old('content') }}</textarea>
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
                                <option value="{{ $key }}" {{ old('status', 'draft') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_enabled" id="is_enabled" value="1"
                               {{ old('is_enabled', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:border-blue-300 focus:ring focus:ring-blue-200">
                        <label for="is_enabled" class="ml-2 text-sm text-gray-700">Artykuł włączony</label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data publikacji</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data zakończenia publikacji</label>
                        <input type="datetime-local" name="published_until" value="{{ old('published_until') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">Pozostaw puste dla publikacji bez ograniczeń czasowych</p>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Główne zdjęcie</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload pliku</label>
                        <input type="file" name="featured_image" accept="image/*"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">Max 2MB, formaty: JPG, PNG, GIF</p>
                    </div>

                    <div class="text-center text-gray-500">LUB</div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL zewnętrznego zdjęcia</label>
                        <input type="url" name="featured_image_url" value="{{ old('featured_image_url') }}"
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
                    <input type="password" name="password"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2"
                           placeholder="Pozostaw puste dla dostępu publicznego">
                    <p class="text-xs text-gray-500 mt-1">Minimum 6 znaków</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 admin-button text-white px-4 py-2 rounded-lg font-medium">
                        Zapisz artykuł
                    </button>
                    <a href="{{ route('admin.admin.blog.index') }}"
                       class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium text-center hover:bg-gray-50">
                        Anuluj
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection