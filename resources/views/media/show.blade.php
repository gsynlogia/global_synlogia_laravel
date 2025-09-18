@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $media->name }}</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('media.public.download', $media) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Pobierz
                    </a>
                    <a href="javascript:history.back()"
                       class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        Wróć
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Podgląd pliku -->
                <div class="md:col-span-2">
                    @if($media->isImage())
                        <div class="border rounded-lg p-4">
                            <img src="{{ route('media.public.show', $media) }}"
                                 alt="{{ $media->name }}"
                                 class="max-w-full h-auto rounded">
                        </div>
                    @elseif($media->extension === 'pdf')
                        <div class="border rounded-lg p-4">
                            <iframe src="{{ route('media.public.show', $media) }}#view=FitH"
                                    width="100%"
                                    height="600px"
                                    class="rounded">
                            </iframe>
                        </div>
                    @elseif($media->isVideo())
                        <div class="border rounded-lg p-4">
                            <video controls class="w-full rounded">
                                <source src="{{ route('media.public.show', $media) }}" type="{{ $media->mime_type }}">
                                Twoja przeglądarka nie obsługuje odtwarzania wideo.
                            </video>
                        </div>
                    @elseif($media->isAudio())
                        <div class="border rounded-lg p-4 text-center">
                            <div class="mb-4">
                                <svg class="w-16 h-16 text-gray-400 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                </svg>
                            </div>
                            <audio controls class="w-full">
                                <source src="{{ route('media.public.show', $media) }}" type="{{ $media->mime_type }}">
                                Twoja przeglądarka nie obsługuje odtwarzania audio.
                            </audio>
                        </div>
                    @else
                        <div class="border rounded-lg p-8 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 4V6h-2v2h2zm-2 2h2v2h-2v-2zm-8 2v2H4v-2h2zm0-2H4V8h2v2zm4 0h2V8h-2v2zm0 2v2h-2v-2h2z"/>
                            </svg>
                            <p class="text-gray-600">Podgląd niedostępny dla tego typu pliku</p>
                            <p class="text-sm text-gray-500 mt-2">Użyj przycisku "Pobierz" aby otworzyć plik</p>
                        </div>
                    @endif
                </div>

                <!-- Informacje o pliku -->
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Informacje o pliku</h3>

                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nazwa:</span>
                                <span class="font-medium">{{ $media->name }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">{{ $media->getHumanReadableSize() }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Typ:</span>
                                <span class="font-medium">{{ strtoupper($media->extension) }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600">Dodano:</span>
                                <span class="font-medium">{{ $media->created_at->format('d.m.Y H:i') }}</span>
                            </div>

                            @if($media->description)
                            <div class="pt-2 border-t">
                                <span class="text-gray-600 block mb-1">Opis:</span>
                                <p class="text-gray-900">{{ $media->description }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Status dostępu -->
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h4 class="text-md font-semibold text-blue-900 mb-2">Poziom dostępu</h4>
                        <span class="inline-block px-2 py-1 text-xs font-medium rounded-full
                            @if($media->access_level === 'public') bg-green-100 text-green-800
                            @elseif($media->access_level === 'authenticated') bg-yellow-100 text-yellow-800
                            @elseif($media->access_level === 'private') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $media->getAccessLevelLabel() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection