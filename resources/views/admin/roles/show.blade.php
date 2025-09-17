@extends('layouts.admin')

@section('title', $role->display_name . ' - Szczegóły Roli - Global Synlogia')
@section('page-title', 'Szczegóły Roli')
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
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $role->display_name }}</span>
            </div>
        </li>
    </ol>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Role Info -->
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-[#124f9e]">Informacje o roli</h3>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.roles.edit', $role) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-[#124f9e] rounded-lg hover:bg-[#0f3f85] transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edytuj
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nazwa wyświetlana</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-medium">{{ $role->display_name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nazwa systemowa</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $role->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            @if($role->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktywna
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Nieaktywna
                                </span>
                            @endif
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Liczba uprawnień</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $role->permissions->count() }} uprawnień</dd>
                    </div>

                    @if($role->description)
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Opis</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $role->description }}</dd>
                        </div>
                    @endif

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Utworzono</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $role->created_at->format('d.m.Y H:i') }}</dd>
                    </div>

                    @if($role->updated_at != $role->created_at)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Ostatnia modyfikacja</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $role->updated_at->format('d.m.Y H:i') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Permissions -->
        @if($role->permissions->count() > 0)
            <div class="bg-white shadow-lg rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-[#124f9e]">Uprawnienia roli</h3>
                </div>

                <div class="p-6">
                    @php
                        $permissionGroups = $role->permissions->groupBy('group');
                    @endphp

                    <div class="space-y-6">
                        @foreach($permissionGroups as $groupName => $permissions)
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 uppercase tracking-wider mb-3 capitalize">
                                    {{ str_replace('_', ' ', $groupName) }}
                                </h4>
                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                    @foreach($permissions as $permission)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $permission->display_name }}</div>
                                                @if($permission->description)
                                                    <div class="text-xs text-gray-500">{{ $permission->description }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Quick Stats -->
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Statystyki</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Użytkownicy z tą rolą</span>
                    <span class="text-sm font-bold text-gray-900">{{ $role->users->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Uprawnienia</span>
                    <span class="text-sm font-bold text-gray-900">{{ $role->permissions->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Grupy uprawnień</span>
                    <span class="text-sm font-bold text-gray-900">{{ $role->permissions->groupBy('group')->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Users with this role -->
        @if($role->users->count() > 0)
            <div class="bg-white shadow-lg rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-[#124f9e]">Użytkownicy z tą rolą</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($role->users as $user)
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                </div>
                                <div>
                                    @if($user->isBlocked())
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Zablokowany
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Aktywny
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Akcje</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.roles.edit', $role) }}" class="w-full admin-button text-white px-4 py-2 rounded-lg transition-all text-center block">
                    Edytuj rolę
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

@endsection