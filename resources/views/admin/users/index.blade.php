@extends('layouts.admin')

@section('title', 'Zarządzanie Użytkownikami - Global Synlogia')
@section('page-title', 'Zarządzanie Użytkownikami')
@section('page-description', 'Pełne zarządzanie użytkownikami systemu')

@section('content')

<!-- Quick Actions -->
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.users.create') }}" class="admin-button text-white px-4 py-2 rounded-lg transition-all">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Dodaj Użytkownika
            </a>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.users.blocked') }}"
               class="inline-flex items-center px-4 py-2 border border-orange-600 text-orange-600 rounded-lg hover:bg-orange-600 hover:text-white transition-colors text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                </svg>
                Zablokowani
            </a>
            <a href="{{ route('admin.users.trash') }}"
               class="inline-flex items-center px-4 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Kosz
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Wszyscy użytkownicy</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Aktywni użytkownicy</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::where('is_active', true)->count() }}</p>
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
                <p class="text-gray-600 text-sm font-medium">Administratorzy</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::whereHas('roles', function($query) { $query->where('name', 'admin'); })->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Zablokowani</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::where('is_active', false)->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="bg-white shadow-lg rounded-lg mb-6">
    <div class="p-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Szukaj użytkowników..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]">
            </div>
            <div>
                <select name="role" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]">
                    <option value="">Wszystkie role</option>
                    @foreach(\App\Models\Role::active()->get() as $role)
                        <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                            {{ $role->display_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]">
                    <option value="">Wszystkie statusy</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktywni</option>
                    <option value="blocked" {{ request('status') === 'blocked' ? 'selected' : '' }}>Zablokowani</option>
                    <option value="admin" {{ request('status') === 'admin' ? 'selected' : '' }}>Administratorzy</option>
                </select>
            </div>
            <button type="submit" class="bg-[#124f9e] text-white px-6 py-2 rounded-lg hover:bg-[#0f3f85] transition-colors">
                Szukaj
            </button>
            @if(request()->hasAny(['search', 'role', 'status']))
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800">
                    Wyczyść filtry
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Users Table -->
<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-[#124f9e]">Lista Użytkowników</h3>
    </div>

    @if($users->count() > 0)
        <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Użytkownik
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ostatnia aktywność
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Akcje
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-[#124f9e] flex items-center justify-center">
                                                    <span class="text-sm font-medium text-white">
                                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            @if($user->isSuperuser())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#de244b] text-white">
                                                    Superuser
                                                </span>
                                            @elseif($user->isAdmin())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#124f9e] text-white">
                                                    Admin
                                                </span>
                                            @endif

                                            @if($user->isBlocked())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Zablokowany
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Aktywny
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($user->roles->count() > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($user->roles as $role)
                                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 text-gray-800">
                                                        {{ $role->display_name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-gray-400">Brak ról</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.users.show', $user) }}"
                                               class="inline-flex items-center px-3 py-1.5 border border-[#124f9e] text-[#124f9e] rounded-md hover:bg-[#124f9e] hover:text-white transition-colors text-xs">
                                                Zobacz
                                            </a>

                                            @if($user->canBeDeletedBy(auth()->user()))
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                   class="inline-flex items-center px-3 py-1.5 border border-yellow-600 text-yellow-600 rounded-md hover:bg-yellow-600 hover:text-white transition-colors text-xs">
                                                    Edytuj
                                                </a>
                                            @endif

                                            @if($user->isBlocked())
                                                @if($user->canBeBlockedBy(auth()->user()))
                                                    <form method="POST" action="{{ route('admin.users.unblock', $user) }}" class="inline">
                                                        @csrf
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 border border-green-600 text-green-600 rounded-md hover:bg-green-600 hover:text-white transition-colors text-xs">
                                                            Odblokuj
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                @if($user->canBeBlockedBy(auth()->user()))
                                                    <button onclick="openBlockModal('{{ $user->id }}', '{{ $user->name }}')"
                                                            class="inline-flex items-center px-3 py-1.5 border border-orange-600 text-orange-600 rounded-md hover:bg-orange-600 hover:text-white transition-colors text-xs">
                                                        Zablokuj
                                                    </button>
                                                @endif
                                            @endif

                                            @if($user->canBeDeletedBy(auth()->user()))
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')"
                                                            class="inline-flex items-center px-3 py-1.5 border border-red-600 text-red-600 rounded-md hover:bg-red-600 hover:text-white transition-colors text-xs">
                                                        Usuń
                                                    </button>
                                                </form>
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
                    {{ $users->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Brak użytkowników</h3>
                    <p class="mt-1 text-sm text-gray-500">Rozpocznij dodając pierwszego użytkownika do systemu.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#124f9e] hover:bg-[#0f3f85]">
                            Dodaj użytkownika
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Block User Modal -->
<div id="blockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Zablokuj użytkownika</h3>
            <form id="blockForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Powód blokady:</label>
                    <textarea name="reason" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]" rows="3" placeholder="Podaj powód blokady użytkownika..."></textarea>
                </div>
                <div class="flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeBlockModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                        Anuluj
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                        Zablokuj użytkownika
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openBlockModal(userId, userName) {
    document.getElementById('blockModal').classList.remove('hidden');
    document.getElementById('blockForm').action = `/admin/users/${userId}/block`;
}

function closeBlockModal() {
    document.getElementById('blockModal').classList.add('hidden');
    document.getElementById('blockForm').reset();
}

// Close modal when clicking outside
document.getElementById('blockModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeBlockModal();
    }
});
</script>
@endpush