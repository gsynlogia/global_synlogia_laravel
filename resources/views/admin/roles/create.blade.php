@extends('layouts.admin')

@section('title', 'Dodaj Rolę - Global Synlogia')
@section('page-title', 'Dodaj Rolę')
@section('page-description', 'Tworzenie nowej roli w systemie')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Powrót do listy ról
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Informacje o roli</h3>
            </div>

            <form method="POST" action="{{ route('admin.roles.store') }}" class="p-6">
                @csrf

                <!-- Display Name -->
                <div class="mb-6">
                    <label for="display_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nazwa wyświetlana *
                    </label>
                    <input type="text"
                           id="display_name"
                           name="display_name"
                           value="{{ old('display_name') }}"
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
                           value="{{ old('name') }}"
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
                              placeholder="Opis funkcjonalności tej roli...">{{ old('description') }}</textarea>
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
                                                   {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
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
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="h-4 w-4 text-[#124f9e] focus:ring-[#124f9e] border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Aktywna rola
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Nieaktywne role nie będą dostępne do przypisania</p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.roles.index') }}"
                       class="text-gray-600 hover:text-gray-800 transition-colors">
                        Anuluj
                    </a>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="admin-button text-white px-6 py-2 rounded-lg transition-all">
                            Dodaj rolę
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
                    <h4 class="font-medium text-gray-900 mb-2">Rola</h4>
                    <p>Role grupują uprawnienia i są przypisywane do użytkowników w celu kontroli dostępu.</p>
                </div>

                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Uprawnienia</h4>
                    <p>Wybierz uprawnienia które będą dostępne dla użytkowników z tą rolą.</p>
                </div>

                <div class="text-sm text-gray-600">
                    <h4 class="font-medium text-gray-900 mb-2">Status</h4>
                    <p>Tylko aktywne role mogą być przypisywane do użytkowników.</p>
                </div>
            </div>
        </div>

        <!-- Permission Groups -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Grupy uprawnień</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach($permissionGroups as $groupName => $permissions)
                        <div class="border-l-4 border-blue-400 pl-4 py-2">
                            <div class="text-sm font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $groupName) }}</div>
                            <div class="text-xs text-gray-500">{{ $permissions->count() }} uprawnień</div>
                        </div>
                    @endforeach
                </div>
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