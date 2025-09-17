@extends('layouts.app')

@section('title', 'Edytuj Uprawnienie - Global Synlogia')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

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
                        <a href="{{ route('admin.permissions.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#124f9e] md:ml-2">
                            Uprawnienia
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <a href="{{ route('admin.permissions.show', $permission) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#124f9e] md:ml-2">
                            {{ $permission->display_name }}
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

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-[#124f9e]">Edytuj Uprawnienie</h1>
                    <p class="text-gray-600 mt-2">{{ $permission->display_name }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-lg rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-[#124f9e]">Informacje o uprawnieniu</h3>
                    </div>

                    <form method="POST" action="{{ route('admin.permissions.update', $permission) }}" class="p-6">
                        @csrf
                        @method('PUT')

                        <!-- Display Name -->
                        <div class="mb-6">
                            <label for="display_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nazwa wyświetlana *
                            </label>
                            <input type="text"
                                   id="display_name"
                                   name="display_name"
                                   value="{{ old('display_name', $permission->display_name) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e] @error('display_name') border-red-500 @enderror"
                                   required>
                            @error('display_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name (slug) -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nazwa systemowa (slug) *
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $permission->name) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e] @error('name') border-red-500 @enderror"
                                   pattern="[a-z0-9._-]+"
                                   title="Dozwolone tylko małe litery, cyfry, kropki, podkreślniki i myślniki"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Dozwolone tylko małe litery, cyfry, kropki, podkreślniki i myślniki</p>
                        </div>

                        <!-- Group -->
                        <div class="mb-6">
                            <label for="group" class="block text-sm font-medium text-gray-700 mb-2">
                                Grupa uprawnień *
                            </label>
                            <select id="group"
                                    name="group"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e] @error('group') border-red-500 @enderror"
                                    required>
                                <option value="">Wybierz grupę</option>
                                <option value="blog" {{ old('group', $permission->group) === 'blog' ? 'selected' : '' }}>Blog</option>
                                <option value="training" {{ old('group', $permission->group) === 'training' ? 'selected' : '' }}>Szkolenia</option>
                                <option value="contact" {{ old('group', $permission->group) === 'contact' ? 'selected' : '' }}>Kontakt</option>
                                <option value="slider" {{ old('group', $permission->group) === 'slider' ? 'selected' : '' }}>Slider</option>
                                <option value="badge_slider" {{ old('group', $permission->group) === 'badge_slider' ? 'selected' : '' }}>Badge Slider</option>
                                <option value="services" {{ old('group', $permission->group) === 'services' ? 'selected' : '' }}>Usługi</option>
                                <option value="technologies" {{ old('group', $permission->group) === 'technologies' ? 'selected' : '' }}>Technologie</option>
                                <option value="users" {{ old('group', $permission->group) === 'users' ? 'selected' : '' }}>Użytkownicy</option>
                                <option value="roles" {{ old('group', $permission->group) === 'roles' ? 'selected' : '' }}>Role</option>
                                <option value="permissions" {{ old('group', $permission->group) === 'permissions' ? 'selected' : '' }}>Uprawnienia</option>
                                <option value="general" {{ old('group', $permission->group) === 'general' ? 'selected' : '' }}>Ogólne</option>
                            </select>
                            @error('group')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Opis
                            </label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e] @error('description') border-red-500 @enderror"
                                      placeholder="Opis funkcjonalności tego uprawnienia...">{{ old('description', $permission->description) }}</textarea>
                            @error('description')
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
                                       {{ old('is_active', $permission->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 text-[#124f9e] focus:ring-[#124f9e] border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Aktywne uprawnienie
                                </label>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Nieaktywne uprawnienia nie będą dostępne do przypisania</p>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.permissions.show', $permission) }}"
                               class="text-gray-600 hover:text-gray-800 transition-colors">
                                Anuluj
                            </a>
                            <div class="flex items-center space-x-4">
                                <button type="submit"
                                        class="bg-[#124f9e] text-white px-6 py-2 rounded-lg hover:bg-[#0f3f85] transition-colors">
                                    Zapisz zmiany
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Permission Info -->
                <div class="bg-white shadow-lg rounded-lg mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-[#124f9e]">Informacje</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status</label>
                            <div class="mt-1">
                                @if($permission->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aktywne
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Nieaktywne
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Grupa</label>
                            <div class="mt-1 text-sm text-gray-900 capitalize">{{ str_replace('_', ' ', $permission->group) }}</div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Przypisane do ról</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $permission->roles->count() }} ról</div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Utworzono</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $permission->created_at->format('d.m.Y H:i') }}</div>
                        </div>

                        @if($permission->updated_at != $permission->created_at)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Ostatnia modyfikacja</label>
                                <div class="mt-1 text-sm text-gray-900">{{ $permission->updated_at->format('d.m.Y H:i') }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Assigned Roles -->
                @if($permission->roles->count() > 0)
                    <div class="bg-white shadow-lg rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-[#124f9e]">Przypisane role</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @foreach($permission->roles as $role)
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $role->display_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $role->name }}</div>
                                        </div>
                                        <div>
                                            @if($role->is_active)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Aktywna
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Nieaktywna
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from display name
document.getElementById('display_name').addEventListener('input', function() {
    const displayName = this.value;
    const nameField = document.getElementById('name');

    if (nameField.value === '' || nameField.dataset.manual !== 'true') {
        const slug = displayName
            .toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '.')
            .replace(/\.+/g, '.')
            .replace(/^\.+|\.+$/g, '');
        nameField.value = slug;
    }
});

// Mark name field as manually edited
document.getElementById('name').addEventListener('input', function() {
    this.dataset.manual = 'true';
});
</script>
@endsection