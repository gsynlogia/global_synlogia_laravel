@extends('layouts.admin')

@section('title', $permission->display_name . ' - Szczegóły Uprawnienia - Global Synlogia')

@section('content')

        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.index') }}" class="text-gray-700 hover:text-[#124f9e]">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Admin
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.permissions.index') }}" class="ml-1 text-gray-700 hover:text-[#124f9e] md:ml-2">Uprawnienia</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2">{{ $permission->display_name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-[#124f9e]">{{ $permission->display_name }}</h1>
                    <p class="text-gray-600 mt-2">Szczegóły uprawnienia systemowego</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.permissions.edit', $permission) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edytuj
                    </a>
                    @if($permission->canBeDeleted())
                        <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Czy na pewno chcesz usunąć uprawnienie {{ $permission->display_name }}?')"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Usuń
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Permission Details -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-[#124f9e]">Informacje o Uprawnieniu</h3>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nazwa wyświetlana</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $permission->display_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nazwa systemowa</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">{{ $permission->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Grupa</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($permission->group) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    @if($permission->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Aktywne
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            Nieaktywne
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Opis</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $permission->description ?: 'Brak opisu' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Data utworzenia</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $permission->created_at->format('d.m.Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Ostatnia modyfikacja</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $permission->updated_at->format('d.m.Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Assigned Roles -->
                @if($permission->roles->count() > 0)
                    <div class="mt-8 bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-[#124f9e]">Role z tym Uprawnieniem</h3>
                            <p class="text-sm text-gray-600 mt-1">Role, które mają przypisane to uprawnienie</p>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Rola
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Użytkownicy
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Akcje
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($permission->roles as $role)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $role->display_name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $role->name }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($role->is_active)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Aktywna
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Nieaktywna
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $role->users->count() }} użytkowników
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.roles.show', $role) }}" class="text-[#124f9e] hover:text-[#0f3f85]">
                                                    Zobacz rolę
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Stats -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-[#124f9e]">Statystyki</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Przypisane role:</span>
                                <span class="text-lg font-semibold text-[#124f9e]">{{ $permission->roles->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Aktywne role:</span>
                                <span class="text-lg font-semibold text-green-600">{{ $permission->roles->where('is_active', true)->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Użytkownicy z tym uprawnieniem:</span>
                                <span class="text-lg font-semibold text-orange-600">
                                    {{ $permission->roles->sum(function($role) { return $role->users->count(); }) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Group Permissions -->
                @php
                    $groupPermissions = \App\Models\Permission::where('group', $permission->group)
                        ->where('id', '!=', $permission->id)
                        ->limit(5)
                        ->get();
                @endphp

                @if($groupPermissions->count() > 0)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-[#124f9e]">Inne uprawnienia w grupie "{{ ucfirst($permission->group) }}"</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @foreach($groupPermissions as $groupPermission)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $groupPermission->display_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $groupPermission->name }}</div>
                                        </div>
                                        <a href="{{ route('admin.permissions.show', $groupPermission) }}" class="text-[#124f9e] hover:text-[#0f3f85] text-sm">
                                            Zobacz
                                        </a>
                                    </div>
                                @endforeach

                                @if(\App\Models\Permission::where('group', $permission->group)->where('id', '!=', $permission->id)->count() > 5)
                                    <div class="text-center pt-2">
                                        <a href="{{ route('admin.permissions.index', ['group' => $permission->group]) }}" class="text-[#124f9e] hover:text-[#0f3f85] text-sm">
                                            Zobacz wszystkie ({{ \App\Models\Permission::where('group', $permission->group)->count() }} uprawnień)
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-[#124f9e]">Akcje</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.permissions.edit', $permission) }}" class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors text-center block">
                                Edytuj uprawnienie
                            </a>

                            <a href="{{ route('admin.permissions.index', ['group' => $permission->group]) }}" class="w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-center block">
                                Zobacz grupę "{{ ucfirst($permission->group) }}"
                            </a>

                            @if($permission->canBeDeleted())
                                <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Czy na pewno chcesz usunąć uprawnienie {{ $permission->display_name }}?')"
                                            class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                        Usuń uprawnienie
                                    </button>
                                </form>
                            @else
                                <div class="w-full bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-center cursor-not-allowed" title="Nie można usunąć uprawnienia przypisanego do roli administratora">
                                    Nie można usunąć
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection