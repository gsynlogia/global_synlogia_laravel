@extends('layouts.admin')

@section('title', 'Dodaj Użytkownika - Global Synlogia')
@section('page-title', 'Dodaj Użytkownika')
@section('page-description', 'Tworzenie nowego użytkownika w systemie')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Powrót do listy użytkowników
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Dane użytkownika</h3>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" class="p-6">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Imię i nazwisko *
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
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
                           value="{{ old('email') }}"
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
                                       {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
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
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="h-4 w-4 text-[#124f9e] focus:ring-[#124f9e] border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Aktywny użytkownik
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Nieaktywni użytkownicy nie mogą się logować</p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}"
                       class="text-gray-600 hover:text-gray-800 transition-colors">
                        Anuluj
                    </a>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="admin-button text-white px-6 py-2 rounded-lg transition-all">
                            Dodaj użytkownika
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Info Card -->
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Informacje</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Logowanie</h4>
                    <p>Użytkownik otrzyma link logowania na podany adres email. Nie ma potrzeby ustawiania hasła.</p>
                </div>

                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Role</h4>
                    <p>Wybierz odpowiednie role dla użytkownika. Role określają uprawnienia w systemie.</p>
                </div>

                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Status</h4>
                    <p>Tylko aktywni użytkownicy mogą się logować do systemu.</p>
                </div>
            </div>
        </div>

        <!-- Available Roles -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Dostępne role</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach(\App\Models\Role::active()->get() as $role)
                        <div class="border-l-4 border-blue-400 pl-4 py-2">
                            <div class="text-sm font-medium text-gray-900">{{ $role->display_name }}</div>
                            <div class="text-xs text-gray-500">{{ $role->permissions->count() }} uprawnień</div>
                            @if($role->description)
                                <div class="text-xs text-gray-600 mt-1">{{ $role->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection