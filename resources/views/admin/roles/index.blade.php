@extends('layouts.admin')

@section('title', 'Zarządzanie Rolami - Global Synlogia')
@section('page-title', 'Zarządzanie Rolami')
@section('page-description', 'Tworzenie i zarządzanie rolami oraz ich uprawnieniami')

@section('content')

<!-- Quick Actions -->
<div class="mb-6">
    <div class="flex items-center justify-end">
        <a href="{{ route('admin.roles.create') }}" class="admin-button text-white px-4 py-2 rounded-lg transition-all">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Dodaj Rolę
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Wszystkie role</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Role::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Aktywne role</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Role::active()->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Dostępne uprawnienia</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Permission::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="p-6">
                <form method="GET" action="{{ route('admin.roles.index') }}" class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-64">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Szukaj ról..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]">
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
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.roles.index') }}" class="text-gray-600 hover:text-gray-800">
                            Wyczyść filtry
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Roles Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Lista Ról</h3>
            </div>

            @if($roles->count() > 0)
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
                                    Uprawnienia
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Użytkownicy
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
                            @foreach($roles as $role)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $role->display_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $role->name }}</div>
                                            @if($role->description)
                                                <div class="text-xs text-gray-400 mt-1">{{ Str::limit($role->description, 50) }}</div>
                                            @endif
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $role->permissions->count() }} uprawnień
                                        </div>
                                        @if($role->permissions->count() > 0)
                                            <div class="text-xs text-gray-500">
                                                {{ $role->permissions->groupBy('group')->keys()->implode(', ') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $role->users->count() }} użytkowników
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $role->created_at->format('d.m.Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.roles.show', $role) }}" class="text-[#124f9e] hover:text-[#0f3f85]">
                                                Szczegóły
                                            </a>
                                            <a href="{{ route('admin.roles.edit', $role) }}" class="text-yellow-600 hover:text-yellow-900">
                                                Edytuj
                                            </a>

                                            @if($role->canBeDeleted())
                                                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Czy na pewno chcesz usunąć rolę {{ $role->display_name }}?')"
                                                            class="text-red-600 hover:text-red-900">
                                                        Usuń
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400" title="Nie można usunąć roli przypisanej do administratora">
                                                    Nie można usunąć
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
                    {{ $roles->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Brak ról</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if(request()->hasAny(['search', 'status']))
                            Nie znaleziono ról spełniających kryteria wyszukiwania.
                        @else
                            Rozpocznij dodając pierwszą rolę do systemu.
                        @endif
                    </p>
                    <div class="mt-6">
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-[#124f9e] bg-[#124f9e] bg-opacity-10 hover:bg-opacity-20">
                                Wyczyść filtry
                            </a>
                        @else
                            <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#124f9e] hover:bg-[#0f3f85]">
                                Dodaj rolę
                            </a>
                        @endif
                    </div>
                </div>
            @endif
    </div>
</div>
@endsection