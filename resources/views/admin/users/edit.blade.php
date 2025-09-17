@extends('layouts.admin')

@section('title', 'Edytuj Użytkownika - Global Synlogia')
@section('page-title', 'Edytuj Użytkownika')
@section('page-description', $user->name)

@section('content')

<!-- Breadcrumb -->
<nav class="flex mb-8" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#124f9e]">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                Admin
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('admin.users.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#124f9e] md:ml-2">
                    Użytkownicy
                </a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('admin.users.show', $user) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#124f9e] md:ml-2">
                    {{ $user->name }}
                </a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edytuj</span>
            </div>
        </li>
    </ol>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Edytuj użytkownika</h3>
            </div>

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Imię i nazwisko *
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e] @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Adres email *
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e] @error('email') border-red-500 @enderror"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Role użytkownika
                    </label>
                    <div class="space-y-3">
                        @foreach(\App\Models\Role::active()->get() as $role)
                            <div class="flex items-center">
                                <input type="checkbox"
                                       id="role_{{ $role->id }}"
                                       name="roles[]"
                                       value="{{ $role->id }}"
                                       {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'checked' : '' }}
                                       class="h-4 w-4 text-[#124f9e] focus:ring-[#124f9e] border-gray-300 rounded">
                                <label for="role_{{ $role->id }}" class="ml-2 block text-sm text-gray-900">
                                    <span class="font-medium">{{ $role->display_name }}</span>
                                    @if($role->description)
                                        <span class="text-gray-500"> - {{ $role->description }}</span>
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div class="mb-8">
                    <div class="flex items-center">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-[#124f9e] focus:ring-[#124f9e] border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Aktywny użytkownik
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Nieaktywni użytkownicy nie mogą się logować</p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.show', $user) }}"
                       class="text-gray-600 hover:text-gray-800 transition-colors">
                        Anuluj
                    </a>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="admin-button text-white px-6 py-2 rounded-lg transition-all">
                            Zaktualizuj użytkownika
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- User Info -->
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Informacje o użytkowniku</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Edycja</h4>
                    <p>Modyfikuj dane użytkownika. Zmiany wpłyną na uprawnienia i dostęp do systemu.</p>
                </div>

                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Role</h4>
                    <p>Wybierz odpowiednie role dla użytkownika. Role określają uprawnienia w systemie.</p>
                </div>

                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Status</h4>
                    <p>Nieaktywni użytkownicy nie mogą się logować do systemu.</p>
                </div>
            </div>
        </div>

        <!-- Current Stats -->
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Aktualne dane</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Liczba ról</span>
                    <span class="text-sm font-bold text-gray-900">{{ $user->roles->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Data rejestracji</span>
                    <span class="text-sm font-bold text-gray-900">{{ $user->created_at->format('d.m.Y') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Status</span>
                    <span class="text-sm font-bold text-gray-900">
                        @if($user->is_active)
                            <span class="text-green-600">Aktywny</span>
                        @else
                            <span class="text-red-600">Nieaktywny</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Akcje</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.users.show', $user) }}" class="w-full px-4 py-2 text-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors block">
                    Zobacz użytkownika
                </a>

                <a href="{{ route('admin.users.index') }}" class="w-full px-4 py-2 text-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors block">
                    Powrót do listy
                </a>
            </div>
        </div>
    </div>
</div>

@endsection