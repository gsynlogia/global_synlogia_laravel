@extends('layouts.app')

@section('title', $blogPost->title . ' - Global Synlogia')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto">
        <!-- Navigation -->
        <div class="mb-6">
            <a href="{{ route('blog.index') }}"
               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                ← Powrót do bloga
            </a>
        </div>

        <!-- Password Form -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-8">
                <div class="text-yellow-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Artykuł chroniony</h1>
                <p class="text-gray-600">Ten artykuł jest chroniony hasłem</p>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $blogPost->title }}</h2>
                @if($blogPost->excerpt)
                    <p class="text-gray-600 text-sm">{{ $blogPost->excerpt }}</p>
                @endif
            </div>

            <form method="POST" action="{{ route('blog.password', $blogPost) }}" class="space-y-6">
                @csrf

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Wprowadź hasło dostępu
                    </label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                           placeholder="Hasło dostępu">

                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-4">
                    <button type="submit"
                            class="flex-1 bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Odblokuj artykuł
                    </button>
                    <a href="{{ route('blog.index') }}"
                       class="flex-1 border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium text-center hover:bg-gray-50 transition-colors">
                        Anuluj
                    </a>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-500">
                    Jeśli nie masz hasła, skontaktuj się z autorem artykułu
                </p>
            </div>
        </div>
    </div>
</div>
@endsection