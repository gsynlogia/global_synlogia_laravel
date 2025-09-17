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
            <a href="{{ route('admin.users.blocked') }}" class="px-4 py-2 text-sm bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition-colors">
                Zablokowani
            </a>
            <a href="{{ route('admin.users.trash') }}" class="px-4 py-2 text-sm bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition-colors">
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
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $users->total() }}</p>
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
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::active()->count() }}</p>
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
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::admins()->count() }}</p>
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
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::blocked()->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18 21l-2.25-2.25m0 0L21 12l-9-9-9 9 6.75 6.75"/>
                </svg>
            </div>
        </div>
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
                                            <a href="{{ route('admin.users.show', $user) }}" class="text-[#124f9e] hover:text-[#0f3f85]">
                                                Szczegóły
                                            </a>

                                            @if($user->canBeDeletedBy(auth()->user()))
                                                <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-600 hover:text-yellow-900">
                                                    Edytuj
                                                </a>
                                            @endif

                                            @if($user->isBlocked())
                                                @if($user->canBeBlockedBy(auth()->user()))
                                                    <form method="POST" action="{{ route('admin.users.unblock', $user) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                                            Odblokuj
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                @if($user->canBeBlockedBy(auth()->user()))
                                                    <button onclick="openBlockModal('{{ $user->id }}', '{{ $user->name }}')" class="text-red-600 hover:text-red-900">
                                                        Zablokuj
                                                    </button>
                                                @endif
                                            @endif

                                            @if($user->canBeDeletedBy(auth()->user()))
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')" class="text-red-600 hover:text-red-900">
                                                        Usuń (soft)
                                                    </button>
                                                </form>
                                            @endif

                                            @if($user->canBeForceDeletedBy(auth()->user()))
                                                <form method="POST" action="{{ route('admin.users.force-destroy', $user) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Czy na pewno chcesz TRWALE usunąć tego użytkownika? Ta operacja jest nieodwracalna!')" class="text-red-800 hover:text-red-900 font-bold">
                                                        Usuń (trwale)
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