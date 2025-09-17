@extends('layouts.admin')

@section('title', 'Szczegóły Użytkownika - Global Synlogia')
@section('page-title', 'Szczegóły Użytkownika')
@section('page-description', 'Przeglądanie informacji o użytkowniku')

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
                <a href="{{ route('admin.users.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#124f9e] md:ml-2">
                    Użytkownicy
                </a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $user->name }}</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Action Buttons -->
<div class="flex justify-between items-center mb-8">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Wszyscy użytkownicy
        </a>
    </div>

    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 border border-[#124f9e] text-[#124f9e] rounded-lg hover:bg-[#124f9e] hover:text-white transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edytuj
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Basic Information -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Podstawowe informacje</h3>
            </div>
            <div class="p-6">
                <div class="flex items-center space-x-6 mb-6">
                    <div class="h-20 w-20 rounded-full bg-gradient-to-br from-[#124f9e] to-[#0f3f85] flex items-center justify-center">
                        <span class="text-2xl font-bold text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <div class="mt-2">
                            @if($user->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktywny
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Nieaktywny
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Imię i nazwisko</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Data utworzenia</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Ostatnia aktualizacja</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('d.m.Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Roles -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Role użytkownika</h3>
            </div>
            <div class="p-6">
                @if($user->roles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($user->roles as $role)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-medium text-gray-900">{{ $role->display_name }}</h4>
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
                                <p class="text-sm text-gray-600">{{ $role->description ?? 'Brak opisu' }}</p>
                                <div class="mt-2">
                                    <span class="text-xs text-gray-500">{{ $role->permissions->count() }} uprawnień</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Brak ról</h3>
                        <p class="mt-1 text-sm text-gray-500">Użytkownik nie ma przypisanych żadnych ról.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- User Actions -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Zarządzanie użytkownikiem</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button onclick="showAddNoteModal()" class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-white bg-[#124f9e] rounded-lg hover:bg-[#0f3f85] transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Dodaj notatkę
                    </button>

                    <button onclick="console.log('Button clicked'); showFullHistoryModal()" class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-[#124f9e] border border-[#124f9e] rounded-lg hover:bg-[#124f9e] hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Historia użytkownika
                        @if($user->notes->count() > 0)
                            <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $user->notes->count() }}
                            </span>
                        @endif
                    </button>
                </div>

                <div class="mt-6 text-center py-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <span>
                            @if($user->notes->count() > 0)
                                Ostatnia aktywność: {{ $user->notes->first()->created_at->diffForHumans() }}
                            @else
                                Brak aktywności - kliknij "Historia użytkownika" aby zobaczyć szczegóły
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Quick Stats -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Statystyki</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Przypisane role</span>
                    <span class="text-sm font-bold text-gray-900">{{ $user->roles->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Uprawnienia</span>
                    <span class="text-sm font-bold text-gray-900">{{ $user->getAllPermissions()->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Status</span>
                    @if($user->is_active)
                        <span class="text-sm font-bold text-green-600">Aktywny</span>
                    @else
                        <span class="text-sm font-bold text-red-600">Nieaktywny</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Szybkie akcje</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="w-full admin-button text-white px-4 py-2 rounded-lg transition-all text-center block">
                    Edytuj użytkownika
                </a>

                @if($user->is_active)
                    <form id="toggle-status-form" method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="w-full">
                        @csrf
                        @method('PATCH')
                        <button type="button"
                                onclick="showToggleStatusModal('{{ $user->name }}', 'block')"
                                class="w-full px-4 py-2 text-center border border-red-600 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors block">
                            Zablokuj użytkownika
                        </button>
                    </form>
                @else
                    <form id="toggle-status-form" method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="w-full">
                        @csrf
                        @method('PATCH')
                        <button type="button"
                                onclick="showToggleStatusModal('{{ $user->name }}', 'unblock')"
                                class="w-full px-4 py-2 text-center border border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors block">
                            Odblokuj użytkownika
                        </button>
                    </form>
                @endif

                <a href="{{ route('admin.users.index') }}" class="w-full px-4 py-2 text-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors block">
                    Wszyscy użytkownicy
                </a>
            </div>
        </div>

        <!-- Account Info -->
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-800">Informacja</h3>
                    <div class="mt-2 text-sm text-gray-600">
                        <p>Konto utworzone {{ $user->created_at->diffForHumans() }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
function showToggleStatusModal(userName, action) {
    const isBlocking = action === 'block';
    const title = isBlocking ? 'Zablokować użytkownika?' : 'Odblokować użytkownika?';
    const message = isBlocking
        ? `Czy na pewno chcesz zablokować użytkownika "${userName}"? Użytkownik nie będzie mógł się logować do systemu.`
        : `Czy na pewno chcesz odblokować użytkownika "${userName}"? Użytkownik odzyska dostęp do systemu.`;
    const confirmText = isBlocking ? 'Zablokuj' : 'Odblokuj';

    showModal(title, message, confirmText, 'Anuluj', function() {
        document.getElementById('toggle-status-form').submit();
    });
}

function showAddNoteModal() {
    const modalContent = `
        <form id="add-note-form" method="POST" action="{{ route('admin.users.add-note', $user) }}" class="space-y-4">
            @csrf
            <div>
                <label for="note-title" class="block text-sm font-medium text-gray-700 mb-2">Tytuł notatki</label>
                <input type="text" id="note-title" name="title" required maxlength="255"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#124f9e] focus:border-transparent"
                       placeholder="Wprowadź tytuł notatki">
            </div>
            <div>
                <label for="note-content" class="block text-sm font-medium text-gray-700 mb-2">Treść notatki</label>
                <textarea id="note-content" name="content" required maxlength="2000" rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#124f9e] focus:border-transparent resize-none"
                          placeholder="Wprowadź treść notatki..."></textarea>
                <div class="text-right mt-1">
                    <span id="char-count" class="text-xs text-gray-500">0/2000</span>
                </div>
            </div>
        </form>
    `;

    showModal('Dodaj notatkę o użytkowniku', modalContent, 'Zapisz notatkę', 'Anuluj', function() {
        document.getElementById('add-note-form').submit();
    });

    // Add character counter
    const textarea = document.getElementById('note-content');
    const charCount = document.getElementById('char-count');
    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length + '/2000';
    });
}

function showFullHistoryModal() {
    // Create modal structure
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 z-50 overflow-y-auto';
    modal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="closeHistoryModal(this)"></div>
            <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Historia użytkownika - {{ $user->name }}</h3>
                    <button onclick="closeHistoryModal(this)" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Filters -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <label class="text-sm font-medium text-gray-700">Sortowanie:</label>
                            <select id="sort-order" onchange="loadHistory()" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#124f9e] focus:border-transparent">
                                <option value="desc">Najnowsze najpierw</option>
                                <option value="asc">Najstarsze najpierw</option>
                            </select>
                        </div>
                        <div class="flex items-center space-x-4">
                            <label class="text-sm font-medium text-gray-700">Filtruj typ:</label>
                            <select id="filter-type" onchange="loadHistory()" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#124f9e] focus:border-transparent">
                                <option value="all">Wszystkie</option>
                                <option value="system">System</option>
                                <option value="login">Logowanie</option>
                                <option value="block">Blokada</option>
                                <option value="unblock">Odblokowanie</option>
                                <option value="permission_change">Zmiany uprawnień</option>
                                <option value="manual">Notatki ręczne</option>
                            </select>
                        </div>
                        <div class="text-sm text-gray-500">
                            Łącznie: <span id="total-count">-</span> wpisów
                        </div>
                    </div>
                </div>

                <!-- History entries -->
                <div id="history-entries" class="space-y-4 max-h-96 overflow-y-auto pr-2">
                    <div class="text-center py-4">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#124f9e] mx-auto"></div>
                        <p class="mt-2 text-sm text-gray-500">Ładowanie historii...</p>
                    </div>
                </div>

                <div class="mt-5 sm:mt-6">
                    <button onclick="closeHistoryModal(this)" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-[#124f9e] border border-transparent rounded-md shadow-sm hover:bg-[#0f3f85] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#124f9e] sm:text-sm">
                        Zamknij
                    </button>
                </div>
            </div>
        </div>
    `;

    document.getElementById('modal-container').appendChild(modal);

    // Load initial history
    loadHistory();
}

function closeHistoryModal(element) {
    const modal = element.closest('.fixed');
    modal.remove();
}

function loadHistory() {
    const sortOrder = document.getElementById('sort-order')?.value || 'desc';
    const filterType = document.getElementById('filter-type')?.value || 'all';
    const historyContainer = document.getElementById('history-entries');
    const totalCount = document.getElementById('total-count');

    if (!historyContainer) return;

    // Show loading
    historyContainer.innerHTML = `
        <div class="text-center py-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#124f9e] mx-auto"></div>
            <p class="mt-2 text-sm text-gray-500">Ładowanie historii...</p>
        </div>
    `;

    // Fetch history via AJAX - Laravel handles sorting at SQL level
    fetch(`{{ route('admin.users.history', $user) }}?filter=${filterType}&sort=${sortOrder}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        renderHistory(data.notes);
        totalCount.textContent = data.count;
    })
    .catch(error => {
        console.error('Error loading history:', error);
        historyContainer.innerHTML = `
            <div class="text-center py-4">
                <p class="text-sm text-red-500">Błąd podczas ładowania historii</p>
            </div>
        `;
    });
}

function renderHistory(notes) {
    const historyContainer = document.getElementById('history-entries');

    if (notes.length === 0) {
        historyContainer.innerHTML = `
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Brak historii</h3>
                <p class="mt-1 text-sm text-gray-500">Ten użytkownik nie ma żadnych notatek w historii.</p>
            </div>
        `;
        return;
    }

    // Notes are already sorted by Laravel - just render them
    let html = '';
    notes.forEach(note => {
        const borderColor = getBorderColor(note.type);

        html += `
            <div class="border-l-4 ${borderColor} bg-gray-50 p-4 rounded-r-lg">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${note.type_color}">
                            ${note.type_icon}
                            <span class="ml-1">${note.type_name}</span>
                        </span>
                        <span class="text-xs text-gray-500">${note.created_at_formatted}</span>
                    </div>
                </div>
                <h4 class="font-medium text-gray-900 mb-2">${escapeHtml(note.title)}</h4>
                <div class="text-sm text-gray-600 mb-3 whitespace-pre-wrap">${escapeHtml(note.content)}</div>
                ${renderMetadata(note.metadata)}
                ${renderCreatedBy(note.created_by)}
            </div>
        `;
    });

    historyContainer.innerHTML = html;
}

function getBorderColor(type) {
    switch(type) {
        case 'block': return 'border-red-400';
        case 'unblock': return 'border-green-400';
        case 'manual': return 'border-purple-400';
        default: return 'border-blue-400';
    }
}

function renderMetadata(metadata) {
    if (!metadata || Object.keys(metadata).length === 0) return '';

    let html = `
        <div class="bg-white rounded p-3 mb-2">
            <h5 class="text-xs font-medium text-gray-700 mb-2">Dodatkowe informacje:</h5>
            <div class="space-y-1">
    `;

    Object.entries(metadata).forEach(([key, value]) => {
        const keyLabel = getKeyLabel(key);
        const valueDisplay = formatValue(key, value);

        html += `
            <div class="flex justify-between text-xs">
                <span class="text-gray-500">${keyLabel}</span>
                <span class="text-gray-900 text-right max-w-xs truncate" title="${escapeHtml(value)}">${valueDisplay}</span>
            </div>
        `;
    });

    html += '</div></div>';
    return html;
}

function getKeyLabel(key) {
    switch(key) {
        case 'ip': return 'Adres IP:';
        case 'user_agent': return 'Przeglądarka:';
        case 'previous_status': return 'Poprzedni status:';
        case 'new_status': return 'Nowy status:';
        case 'created_at': return 'Data utworzenia:';
        case 'login_time': return 'Czas logowania:';
        default: return key.charAt(0).toUpperCase() + key.slice(1).replace('_', ' ') + ':';
    }
}

function formatValue(key, value) {
    if (key === 'previous_status' || key === 'new_status') {
        switch(value) {
            case 'active': return '<span class="text-green-600">Aktywny</span>';
            case 'blocked': return '<span class="text-red-600">Zablokowany</span>';
            default: return escapeHtml(value);
        }
    }
    return escapeHtml(value);
}

function renderCreatedBy(createdBy) {
    if (!createdBy) return '';

    return `
        <div class="flex items-center space-x-2 text-xs text-gray-500">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            <span>Utworzone przez: ${escapeHtml(createdBy.name)}</span>
        </div>
    `;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
@endpush

@endsection