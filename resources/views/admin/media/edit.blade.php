@extends('layouts.admin')

@section('title', 'Edycja: ' . $media->name . ' - Global Synlogia')
@section('page-title', 'Edycja ' . ($media->is_folder ? 'folderu' : 'pliku'))
@section('page-description', 'Edytowanie właściwości ' . ($media->is_folder ? 'folderu' : 'pliku'))

@section('content')
<form method="POST" action="{{ route('admin.media.update', $media) }}">
    @csrf
    @method('PUT')

    <div class="flex gap-6">
        <!-- Główna zawartość -->
        <div class="flex-1 space-y-6">
            <!-- Podstawowe informacje -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Podstawowe informacje</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nazwa {{ $media->is_folder ? 'folderu' : 'pliku' }} *
                        </label>
                        <input type="text" name="name" value="{{ old('name', $media->name) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Opis</label>
                        <textarea name="description" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('description') border-red-500 @enderror"
                                  placeholder="Opcjonalny opis {{ $media->is_folder ? 'folderu' : 'pliku' }}">{{ old('description', $media->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            @if(!$media->is_folder)
                <!-- Informacje o pliku -->
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informacje o pliku</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Typ pliku</label>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ strtoupper($media->extension) }}
                                </span>
                                <span class="text-sm text-gray-500">{{ $media->mime_type }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rozmiar</label>
                            <p class="text-sm text-gray-900">{{ $media->getHumanReadableSize() }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Przesłane przez</label>
                            <p class="text-sm text-gray-900">{{ $media->uploadedBy->name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Data przesłania</label>
                            <p class="text-sm text-gray-900">{{ $media->created_at->format('d.m.Y H:i') }}</p>
                        </div>

                        @if($media->metadata && count($media->metadata) > 0)
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Metadane</label>
                                <div class="space-y-1">
                                    @foreach($media->metadata as $key => $value)
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">{{ ucfirst($key) }}:</span>
                                            <span class="text-gray-900">{{ $value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Podgląd pliku -->
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Podgląd</h3>

                    <div class="text-center">
                        @if($media->isImage())
                            <!-- Podgląd obrazu -->
                            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"
                                 class="max-w-full max-h-96 mx-auto rounded-lg shadow-sm">
                        @elseif($media->isVideo())
                            <!-- Podgląd wideo -->
                            <video controls class="max-w-full max-h-96 mx-auto rounded-lg shadow-sm">
                                <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                                Twoja przeglądarka nie obsługuje elementu video.
                            </video>
                        @elseif($media->isAudio())
                            <!-- Podgląd audio -->
                            <div class="p-8">
                                <div class="mb-4">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $media->getIcon() }}"/>
                                    </svg>
                                </div>
                                <audio controls class="w-full max-w-md mx-auto">
                                    <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                                    Twoja przeglądarka nie obsługuje elementu audio.
                                </audio>
                            </div>
                        @else
                            <!-- Ikona dla innych typów plików -->
                            <div class="p-8">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $media->getIcon() }}"/>
                                </svg>
                                <p class="text-gray-600">Podgląd niedostępny dla tego typu pliku</p>
                                <a href="{{ route('admin.media.download', $media) }}"
                                   class="inline-flex items-center mt-4 px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m5-2V8a2 2 0 00-2-2H7a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-2"/>
                                    </svg>
                                    Pobierz plik
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="w-80 space-y-6">
            <!-- Akcje -->
            <div class="bg-white rounded-xl border border-gray-100 p-6 sticky top-6">
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 admin-button text-white px-4 py-2 rounded-lg font-medium">
                        Zapisz zmiany
                    </button>
                    <a href="{{ route('admin.media.index', ['folder' => $media->parent_id]) }}"
                       class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium text-center hover:bg-gray-50">
                        Anuluj
                    </a>
                </div>
            </div>

            <!-- Ustawienia dostępu -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ustawienia dostępu</h3>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_public" id="is_public" value="1"
                               {{ old('is_public', $media->is_public) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:border-blue-300 focus:ring focus:ring-blue-200">
                        <label for="is_public" class="ml-2 text-sm text-gray-700">
                            {{ $media->is_folder ? 'Folder' : 'Plik' }} publiczny
                        </label>
                    </div>

                    <div class="text-xs text-gray-500">
                        {{ $media->is_folder ? 'Foldery' : 'Pliki' }} publiczne są dostępne bez logowania
                    </div>
                </div>
            </div>

            <!-- Lokalizacja -->
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Lokalizacja</h3>

                <div class="space-y-2">
                    @if($media->parent)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                            W folderze: {{ $media->parent->name }}
                        </div>
                    @else
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                            W katalogu głównym
                        </div>
                    @endif

                    @if(!$media->is_folder)
                        <div class="pt-3 border-t border-gray-100">
                            <div class="text-xs text-gray-500 mb-2">URL pliku:</div>
                            <div class="p-2 bg-gray-50 border border-gray-200 rounded text-xs break-all">
                                {{ $media->getUrl() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if(!$media->is_folder)
                <!-- Szybkie akcje -->
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Szybkie akcje</h3>

                    <div class="space-y-2">
                        <a href="{{ $media->getUrl() }}" target="_blank"
                           class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Otwórz w nowej karcie
                        </a>

                        <a href="{{ route('admin.media.download', $media) }}"
                           class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m5-2V8a2 2 0 00-2-2H7a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-2"/>
                            </svg>
                            Pobierz plik
                        </a>

                        <button onclick="copyUrlToClipboard()"
                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Skopiuj URL
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</form>

@push('scripts')
<script>
function copyUrlToClipboard() {
    const url = '{{ $media->getUrl() }}';

    navigator.clipboard.writeText(url).then(function() {
        showToast('URL został skopiowany do schowka', 'success');
    }, function(err) {
        console.error('Błąd podczas kopiowania: ', err);
        showToast('Nie udało się skopiować URL', 'error');
    });
}
</script>
@endpush
@endsection