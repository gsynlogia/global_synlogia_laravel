@extends('layouts.admin')

@section('title', 'Edytuj Rolę - Global Synlogia')
@section('page-title', 'Edytuj Rolę')
@section('page-description', $role->display_name)

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
                <a href="{{ route('admin.roles.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#124f9e] md:ml-2">
                    Role
                </a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('admin.roles.show', $role) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#124f9e] md:ml-2">
                    {{ $role->display_name }}
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
                <h3 class="text-lg font-medium text-[#124f9e]">Edytuj rolę</h3>
            </div>

            <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="p-6">
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
                           value="{{ old('display_name', $role->display_name) }}"
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
                           value="{{ old('name', $role->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e] @error('name') border-red-500 @enderror"
                           pattern="[a-z0-9._-]+"
                           title="Dozwolone tylko małe litery, cyfry, kropki, podkreślniki i myślniki"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Dozwolone tylko małe litery, cyfry, kropki, podkreślniki i myślniki</p>
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
                              placeholder="Opis funkcjonalności tej roli...">{{ old('description', $role->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Permissions Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Uprawnienia roli
                    </label>
                    <div class="border border-gray-300 rounded-lg p-4 max-h-64 overflow-y-auto">
                        @php
                            $permissionGroups = \App\Models\Permission::active()->get()->groupBy('group');
                            $currentPermissions = old('permissions', $role->permissions->pluck('id')->toArray());
                        @endphp

                        @foreach($permissionGroups as $groupName => $permissions)
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-900 mb-2 capitalize">{{ str_replace('_', ' ', $groupName) }}</h4>
                                <div class="space-y-2 ml-4">
                                    @foreach($permissions as $permission)
                                        <div class="flex items-center">
                                            <input type="checkbox"
                                                   id="permission_{{ $permission->id }}"
                                                   name="permissions[]"
                                                   value="{{ $permission->id }}"
                                                   {{ in_array($permission->id, $currentPermissions) ? 'checked' : '' }}
                                                   class="h-4 w-4 text-[#124f9e] focus:ring-[#124f9e] border-gray-300 rounded">
                                            <label for="permission_{{ $permission->id }}" class="ml-2 block text-sm text-gray-900">
                                                <span class="font-medium">{{ $permission->display_name }}</span>
                                                @if($permission->description)
                                                    <span class="text-gray-500"> - {{ $permission->description }}</span>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('permissions')
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
                               {{ old('is_active', $role->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-[#124f9e] focus:ring-[#124f9e] border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Aktywna rola
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Nieaktywne role nie będą dostępne do przypisania</p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.roles.show', $role) }}"
                       class="text-gray-600 hover:text-gray-800 transition-colors">
                        Anuluj
                    </a>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="admin-button text-white px-6 py-2 rounded-lg transition-all">
                            Zaktualizuj rolę
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Role Info -->
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Informacje o roli</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Edycja</h4>
                    <p>Modyfikuj nazwę, opis i uprawnienia tej roli. Zmiany wpłyną na wszystkich użytkowników z tą rolą.</p>
                </div>

                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Uprawnienia</h4>
                    <p>Wybierz odpowiednie uprawnienia dla tej roli. Zmiany zostaną zastosowane natychmiast.</p>
                </div>

                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Status</h4>
                    <p>Nieaktywne role nie będą dostępne do przypisania nowym użytkownikom.</p>
                </div>
            </div>
        </div>

        <!-- Current Stats -->
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Aktualne statystyki</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Użytkownicy z tą rolą</span>
                    <span class="text-sm font-bold text-gray-900">{{ $role->users->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Aktualne uprawnienia</span>
                    <span class="text-sm font-bold text-gray-900">{{ $role->permissions->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Grupy uprawnień</span>
                    <span class="text-sm font-bold text-gray-900">{{ $role->permissions->groupBy('group')->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Akcje</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.roles.show', $role) }}" class="w-full px-4 py-2 text-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors block">
                    Zobacz rolę
                </a>

                @if($role->canBeDeleted())
                    <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Czy na pewno chcesz usunąć rolę {{ $role->display_name }}?')"
                                class="w-full danger-button text-white px-4 py-2 rounded-lg transition-all">
                            Usuń rolę
                        </button>
                    </form>
                @else
                    <div class="text-center p-3 bg-gray-100 rounded-lg">
                        <span class="text-sm text-gray-600">Nie można usunąć tej roli</span>
                    </div>
                @endif

                <a href="{{ route('admin.roles.index') }}" class="w-full px-4 py-2 text-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors block">
                    Powrót do listy
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from display name (if field is empty)
document.getElementById('display_name').addEventListener('input', function() {
    const displayName = this.value;
    const nameField = document.getElementById('name');

    if (nameField.dataset.manual !== 'true') {
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