@extends('layouts.admin')

@section('title', 'Zarządzanie Uprawnieniami - Global Synlogia')
@section('page-title', 'Zarządzanie Uprawnieniami')
@section('page-description', 'Tworzenie i zarządzanie uprawnieniami systemowymi')

@section('content')

<!-- Quick Actions -->
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.permissions.create') }}" class="admin-button text-white px-4 py-2 rounded-lg transition-all">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Dodaj Uprawnienie
            </a>
        </div>
        <div>
            <button onclick="openCrudModal()"
                    class="inline-flex items-center px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Generuj CRUD
            </button>
        </div>
    </div>
</div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-green-500">{{ \App\Models\Permission::count() }}</div>
                            <div class="text-sm text-gray-600">Wszystkie uprawnienia</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-blue-500">{{ \App\Models\Permission::active()->count() }}</div>
                            <div class="text-sm text-gray-600">Aktywne</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-purple-500">{{ count(\App\Models\Permission::getGroups()) }}</div>
                            <div class="text-sm text-gray-600">Grupy uprawnień</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-orange-500">{{ \App\Models\Role::count() }}</div>
                            <div class="text-sm text-gray-600">Role wykorzystujące</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="p-6">
                <form method="GET" action="{{ route('admin.permissions.index') }}" class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-64">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Szukaj uprawnień..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]">
                    </div>
                    <div>
                        <select name="group" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]">
                            <option value="">Wszystkie grupy</option>
                            @foreach($groups as $group)
                                <option value="{{ $group }}" {{ request('group') === $group ? 'selected' : '' }}>
                                    {{ ucfirst($group) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]">
                            <option value="">Wszystkie statusy</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktywne</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nieaktywne</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-[#124f9e] text-white px-6 py-2 rounded-lg hover:bg-[#0f3f85] transition-colors">
                        Szukaj
                    </button>
                    @if(request()->hasAny(['search', 'group', 'status']))
                        <a href="{{ route('admin.permissions.index') }}" class="text-gray-600 hover:text-gray-800">
                            Wyczyść filtry
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Permissions Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Lista Uprawnień</h3>
            </div>

            @if($permissions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Uprawnienie
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Grupa
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Utworzono
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Akcje
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($permissions as $permission)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $permission->display_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $permission->name }}</div>
                                            @if($permission->description)
                                                <div class="text-xs text-gray-400 mt-1">{{ Str::limit($permission->description, 60) }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($permission->group) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($permission->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Aktywne
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Nieaktywne
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $permission->roles->count() }} ról
                                        @if($permission->roles->count() > 0)
                                            <div class="text-xs text-gray-500">
                                                {{ $permission->roles->pluck('display_name')->take(2)->implode(', ') }}
                                                @if($permission->roles->count() > 2)
                                                    i {{ $permission->roles->count() - 2 }} więcej
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $permission->created_at->format('d.m.Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.permissions.show', $permission) }}"
                                               class="inline-flex items-center px-3 py-1.5 border border-[#124f9e] text-[#124f9e] rounded-md hover:bg-[#124f9e] hover:text-white transition-colors text-xs">
                                                Zobacz
                                            </a>
                                            <a href="{{ route('admin.permissions.edit', $permission) }}"
                                               class="inline-flex items-center px-3 py-1.5 border border-yellow-600 text-yellow-600 rounded-md hover:bg-yellow-600 hover:text-white transition-colors text-xs">
                                                Edytuj
                                            </a>

                                            @if($permission->canBeDeleted())
                                                <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Czy na pewno chcesz usunąć uprawnienie {{ $permission->display_name }}?')"
                                                            class="inline-flex items-center px-3 py-1.5 border border-red-600 text-red-600 rounded-md hover:bg-red-600 hover:text-white transition-colors text-xs">
                                                        Usuń
                                                    </button>
                                                </form>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-gray-400 rounded-md cursor-not-allowed text-xs"
                                                      title="Nie można usunąć uprawnienia przypisanego do roli administratora">
                                                    Zablokowane
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $permissions->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Brak uprawnień</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if(request()->hasAny(['search', 'group', 'status']))
                            Nie znaleziono uprawnień spełniających kryteria wyszukiwania.
                        @else
                            Rozpocznij dodając pierwsze uprawnienie do systemu.
                        @endif
                    </p>
                    <div class="mt-6">
                        @if(request()->hasAny(['search', 'group', 'status']))
                            <a href="{{ route('admin.permissions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-[#124f9e] bg-[#124f9e] bg-opacity-10 hover:bg-opacity-20">
                                Wyczyść filtry
                            </a>
                        @else
                            <a href="{{ route('admin.permissions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#124f9e] hover:bg-[#0f3f85]">
                                Dodaj uprawnienie
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Permission Groups Overview -->
        @if(\App\Models\Permission::count() > 0)
            <div class="mt-8 bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-[#124f9e]">Przegląd Grup Uprawnień</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach(\App\Models\Permission::getGroups() as $group)
                            @php
                                $groupCount = \App\Models\Permission::where('group', $group)->count();
                                $groupDisplayNames = \App\Models\Permission::getGroupDisplayNames();
                                $displayName = $groupDisplayNames[$group] ?? ucfirst($group);
                            @endphp
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">{{ $displayName }}</h4>
                                        <p class="text-sm text-gray-500">{{ $groupCount }} uprawnień</p>
                                    </div>
                                    <a href="{{ route('admin.permissions.index', ['group' => $group]) }}" class="text-[#124f9e] hover:text-[#0f3f85] text-sm">
                                        Zobacz →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection