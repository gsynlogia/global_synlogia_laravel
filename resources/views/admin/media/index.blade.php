@extends('layouts.admin')

@section('title', 'Media Manager - Global Synlogia')
@section('page-title', 'Media Manager')
@section('page-description', 'Zarządzanie plikami i mediami')

@section('content')
<div class="space-y-6">
    <!-- Górny pasek z akcjami -->
    <div class="bg-white rounded-xl border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-sm text-gray-600">
                    <a href="{{ route('admin.media.index') }}" class="hover:text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </a>

                    @foreach($breadcrumb as $folder)
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <a href="{{ route('admin.media.index', ['folder' => $folder->id]) }}" class="hover:text-blue-600">
                            {{ $folder->name }}
                        </a>
                    @endforeach

                    @if($currentFolder)
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-gray-800 font-medium">{{ $currentFolder->name }}</span>
                    @endif
                </nav>
            </div>

            <div class="flex items-center space-x-3">
                <!-- Przycisk tworzenia folderu -->
                <button onclick="showCreateFolderModal()" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Nowy folder
                </button>

                <!-- Przycisk uploadu -->
                <button onclick="document.getElementById('file-upload').click()" class="inline-flex items-center admin-button text-white px-4 py-2 rounded-lg font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Upload plików
                </button>

                <!-- Ukryty input plików -->
                <form id="upload-form" action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" id="file-upload" name="file" multiple accept="*/*" onchange="handleFileSelect(this)">
                    <input type="hidden" name="folder_id" value="{{ $currentFolder?->id }}">
                </form>
            </div>
        </div>
    </div>

    <!-- Obszar drag & drop -->
    <div id="drop-zone" class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-12 text-center hover:border-blue-400 transition-colors">
        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
        </svg>
        <p class="text-lg font-medium text-gray-600 mb-2">Przeciągnij i upuść pliki tutaj</p>
        <p class="text-gray-500">lub kliknij przycisk "Upload plików" powyżej</p>
    </div>

    <!-- Upload progress indicator -->
    <div id="upload-progress" class="hidden bg-white rounded-xl border border-gray-200 p-6 mb-6">
        <div class="flex items-center mb-4">
            <svg class="animate-spin h-5 w-5 text-blue-500 mr-3" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900">Przesyłanie plików...</h3>
        </div>
        <div id="upload-list" class="space-y-3">
            <!-- Lista przesyłanych plików będzie tutaj -->
        </div>
    </div>

    <!-- Lista plików i folderów -->
    <div class="bg-white rounded-xl border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">
                @if($currentFolder)
                    Zawartość folderu: {{ $currentFolder->name }}
                @else
                    Wszystkie pliki
                @endif
                <span class="text-sm font-normal text-gray-500">({{ $items->total() }} elementów)</span>
            </h3>
        </div>

        @if($items->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-4 p-6" id="media-grid">
                @foreach($items as $item)
                    <div class="media-item group relative bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors cursor-pointer"
                         data-id="{{ $item->id }}"
                         data-type="{{ $item->is_folder ? 'folder' : 'file' }}">

                        <!-- Podgląd ikony/obrazu -->
                        <div class="aspect-square mb-3 flex items-center justify-center">
                            @if($item->is_folder)
                                <!-- Ikona folderu -->
                                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item->getIcon() }}"/>
                                </svg>
                            @elseif($item->isImage())
                                <!-- Miniatura obrazu -->
                                <img src="{{ $item->getUrl() }}" alt="{{ $item->name }}"
                                     class="w-full h-full object-cover rounded">
                            @else
                                <!-- Ikona pliku -->
                                <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item->getIcon() }}"/>
                                </svg>
                            @endif
                        </div>

                        <!-- Nazwa pliku -->
                        <div class="text-center">
                            <p class="text-sm font-medium text-gray-900 truncate" title="{{ $item->name }}">
                                {{ $item->name }}
                            </p>
                            @if(!$item->is_folder)
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $item->getHumanReadableSize() }}
                                </p>
                            @endif

                            <!-- Status badges -->
                            <div class="flex justify-center space-x-1 mt-1">
                                @if($item->is_blocked)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                        🚫 Zablokowany
                                    </span>
                                @endif

                                @if($item->access_level !== 'public')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                        {{ $item->access_level === 'private' ? 'bg-yellow-100 text-yellow-800' :
                                           ($item->access_level === 'authenticated' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $item->getAccessLevelLabel() }}
                                    </span>
                                @endif

                                @if($item->access_token)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        🔗 Link
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Menu akcji (pokazuje się po hover) -->
                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button onclick="showItemActionsModal({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ $item->is_folder ? 'folder' : 'file' }}', {{ $item->is_blocked ? 'true' : 'false' }})"
                                    class="p-1 bg-white rounded-full shadow-sm hover:bg-gray-50">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginacja -->
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $items->links() }}
            </div>
        @else
            <div class="p-12 text-center text-gray-500">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                <p class="text-lg font-medium mb-2">Folder jest pusty</p>
                <p>Dodaj pierwsze pliki używając przycisku Upload lub przeciągając je tutaj</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal tworzenia folderu -->
<div id="create-folder-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="hideCreateFolderModal()"></div>

        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
            <div class="flex items-center space-x-3 mb-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Utwórz nowy folder</h3>
            </div>

            <form id="create-folder-form" action="{{ route('admin.media.store') }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $currentFolder?->id }}">

                <div class="mb-6">
                    <label for="folder_name" class="block text-sm font-medium text-gray-700 mb-2">Nazwa folderu</label>
                    <input type="text" id="folder_name" name="folder_name" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Wprowadź nazwę folderu">
                </div>

                <div class="flex space-x-3 justify-end">
                    <button type="button" onclick="hideCreateFolderModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        Anuluj
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white admin-button rounded-md transition-colors">
                        Utwórz folder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal zarządzania dostępem -->
<div id="access-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="hideAccessModal()"></div>

        <div class="inline-block w-full max-w-2xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
            <div class="flex items-center space-x-3 mb-6">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Zarządzanie dostępem</h3>
            </div>

            <div class="space-y-6" id="access-content">
                <!-- Poziom dostępu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Poziom dostępu</label>
                    <select id="access-level" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="public">Publiczny - dostępny dla wszystkich</option>
                        <option value="authenticated">Tylko zalogowani użytkownicy</option>
                        <option value="private">Prywatny - tylko wybrani użytkownicy</option>
                        <option value="blocked">Zablokowany</option>
                    </select>
                </div>

                <!-- Sekcja przypisanych użytkowników (pokazuje się dla private) -->
                <div id="private-users-section" class="hidden">
                    <h4 class="text-md font-medium text-gray-900 mb-3">Uprawnieni użytkownicy</h4>

                    <!-- Dodawanie użytkownika -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <select id="user-select" class="border border-gray-300 rounded-lg px-3 py-2">
                                <option value="">Wybierz użytkownika...</option>
                                <!-- Opcje będą dodawane dynamicznie -->
                            </select>
                            <select id="permission-select" class="border border-gray-300 rounded-lg px-3 py-2">
                                <option value="view">Tylko podgląd</option>
                                <option value="download">Podgląd + pobieranie</option>
                                <option value="edit">Podgląd + pobieranie + edycja</option>
                                <option value="admin">Pełne uprawnienia</option>
                            </select>
                            <button onclick="assignUser()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Dodaj
                            </button>
                        </div>
                    </div>

                    <!-- Lista przypisanych użytkowników -->
                    <div id="assigned-users-list" class="space-y-2">
                        <!-- Będzie wypełniane dynamicznie -->
                    </div>
                </div>

                <!-- Generowanie linku dostępu -->
                <div>
                    <h4 class="text-md font-medium text-gray-900 mb-3">Link tymczasowy</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center space-x-3 mb-3">
                            <input type="number" id="link-hours" placeholder="Liczba godzin (opcjonalnie)"
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2" min="1" max="168">
                            <button onclick="generateAccessLink()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Generuj link
                            </button>
                        </div>
                        <div id="access-link-result" class="hidden">
                            <div class="text-sm text-gray-600 mb-1">Link dostępu:</div>
                            <div class="flex items-center space-x-2">
                                <input type="text" id="access-link-url" readonly
                                       class="flex-1 bg-white border border-gray-300 rounded px-2 py-1 text-xs">
                                <button onclick="copyAccessLink()" class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs hover:bg-blue-200">
                                    Kopiuj
                                </button>
                                <button onclick="revokeAccessLink()" class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs hover:bg-red-200">
                                    Usuń
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3 justify-end mt-6">
                <button type="button" onclick="hideAccessModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Anuluj
                </button>
                <button type="button" onclick="saveAccessSettings()" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Zapisz zmiany
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal akcji elementu -->
<div id="item-actions-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="hideItemActionsModal()"></div>

        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
            <div class="flex items-center space-x-3 mb-6">
                <div class="flex-shrink-0">
                    <svg id="actions-icon" class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Akcje</h3>
                    <p id="actions-item-name" class="text-sm text-gray-500"></p>
                </div>
            </div>

            <div class="space-y-2" id="actions-content">
                <!-- Będzie wypełniane dynamicznie -->
            </div>

            <div class="flex justify-end mt-6">
                <button type="button" onclick="hideItemActionsModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Zamknij
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Drag & Drop funkcjonalność
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('file-upload');
const uploadForm = document.getElementById('upload-form');

// Obsługa drag & drop
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-blue-400', 'bg-blue-50');
});

dropZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-blue-400', 'bg-blue-50');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-blue-400', 'bg-blue-50');

    const files = e.dataTransfer.files;
    handleFiles(files);
});

// Obsługa wyboru plików
function handleFileSelect(input) {
    handleFiles(input.files);
}

let uploadQueue = [];
let currentUploadIndex = 0;

function handleFiles(files) {
    uploadQueue = Array.from(files);
    currentUploadIndex = 0;

    if (uploadQueue.length > 0) {
        showUploadProgress();
        // Rozpocznij upload pierwszego pliku (sekwencyjnie)
        uploadNextFile();
    }
}

function uploadNextFile() {
    if (currentUploadIndex < uploadQueue.length) {
        const file = uploadQueue[currentUploadIndex];
        uploadFile(file, currentUploadIndex);
    } else {
        // Wszystkie pliki zostały przetworzone
        setTimeout(() => {
            document.getElementById('upload-progress').classList.add('hidden');
            location.reload();
        }, 2000);
    }
}

function showUploadProgress() {
    const progressDiv = document.getElementById('upload-progress');
    const uploadList = document.getElementById('upload-list');

    progressDiv.classList.remove('hidden');
    uploadList.innerHTML = '';

    // Dodaj każdy plik do listy
    uploadQueue.forEach((file, index) => {
        const fileItem = document.createElement('div');
        fileItem.className = 'p-3 bg-gray-50 rounded-lg';
        fileItem.id = `upload-item-${index}`;

        fileItem.innerHTML = `
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-4 w-4 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">${file.name}</span>
                        <span class="text-xs text-gray-500 ml-2">(${formatFileSize(file.size)})</span>
                    </div>
                    <span class="text-xs text-gray-500 font-medium">Oczekuje...</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 hidden" id="progress-bar-${index}">
                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%" id="progress-fill-${index}"></div>
                </div>
                <div class="text-xs text-gray-500 hidden" id="progress-text-${index}">0% - 0 KB / ${formatFileSize(file.size)}</div>
            </div>
        `;

        uploadList.appendChild(fileItem);
    });
}

function startUploadItem(index) {
    const item = document.getElementById(`upload-item-${index}`);
    if (!item) return;

    const spinner = item.querySelector('svg');
    const statusSpan = item.querySelector('.text-gray-500:last-child');
    const progressBar = document.getElementById(`progress-bar-${index}`);
    const progressText = document.getElementById(`progress-text-${index}`);

    // Pokaż progress bar i tekst
    progressBar.classList.remove('hidden');
    progressText.classList.remove('hidden');

    // Zmień spinner na animowany
    spinner.innerHTML = `
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    `;
    spinner.classList.add('animate-spin', 'text-blue-500');
    statusSpan.textContent = 'Przesyłanie...';
    statusSpan.className = 'text-xs text-blue-600 font-medium';
}

function updateProgress(index, loaded, total) {
    const progressFill = document.getElementById(`progress-fill-${index}`);
    const progressText = document.getElementById(`progress-text-${index}`);

    if (!progressFill || !progressText) return;

    const percent = Math.round((loaded / total) * 100);
    progressFill.style.width = percent + '%';
    progressText.textContent = `${percent}% - ${formatFileSize(loaded)} / ${formatFileSize(total)}`;
}

function finishUploadItem(index, status, message = '') {
    const item = document.getElementById(`upload-item-${index}`);
    if (!item) return;

    const spinner = item.querySelector('svg');
    const statusSpan = item.querySelector('.font-medium:last-child');
    const progressFill = document.getElementById(`progress-fill-${index}`);

    if (status === 'success') {
        spinner.innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
        spinner.classList.remove('animate-spin', 'text-blue-500');
        spinner.classList.add('text-green-500');
        statusSpan.textContent = 'Gotowe ✓';
        statusSpan.className = 'text-xs text-green-600 font-medium';
        item.className = 'p-3 bg-green-50 rounded-lg';
        if (progressFill) progressFill.style.width = '100%';
        if (progressFill) progressFill.classList.add('bg-green-500');
    } else if (status === 'error') {
        spinner.innerHTML = '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
        spinner.classList.remove('animate-spin', 'text-blue-500');
        spinner.classList.add('text-red-500');
        statusSpan.textContent = message || 'Błąd ✗';
        statusSpan.className = 'text-xs text-red-600 font-medium';
        item.className = 'p-3 bg-red-50 rounded-lg';
        if (progressFill) progressFill.classList.add('bg-red-500');
    }

    // Przejdź do następnego pliku po 1 sekundzie
    setTimeout(() => {
        currentUploadIndex++;
        uploadNextFile();
    }, 1000);
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 B';
    const k = 1024;
    const sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
}

function uploadFile(file, index) {
    // Rozpocznij upload tego pliku
    startUploadItem(index);

    const formData = new FormData();
    formData.append('file', file);
    formData.append('folder_id', document.querySelector('input[name="folder_id"]').value);
    formData.append('_token', document.querySelector('input[name="_token"]').value);

    const xhr = new XMLHttpRequest();

    // Progress tracking
    xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable) {
            updateProgress(index, e.loaded, e.total);
        }
    });

    // Upload completed
    xhr.addEventListener('load', function() {
        try {
            const data = JSON.parse(xhr.responseText);
            if (xhr.status === 200 && data.success) {
                finishUploadItem(index, 'success');
                showToast(data.message, 'success');
            } else {
                finishUploadItem(index, 'error', data.error || 'Błąd przesyłania');
                showToast(data.error || 'Wystąpił błąd podczas przesyłania', 'error');
            }
        } catch (e) {
            finishUploadItem(index, 'error', 'Błąd odpowiedzi serwera');
            showToast('Błąd odpowiedzi serwera', 'error');
        }
    });

    // Upload error
    xhr.addEventListener('error', function() {
        finishUploadItem(index, 'error', 'Błąd sieci');
        showToast('Wystąpił błąd podczas przesyłania pliku: ' + file.name, 'error');
    });

    // Upload timeout
    xhr.addEventListener('timeout', function() {
        finishUploadItem(index, 'error', 'Przekroczono czas oczekiwania');
        showToast('Przekroczono czas oczekiwania dla pliku: ' + file.name, 'error');
    });

    xhr.timeout = 600000; // 10 minut timeout
    xhr.open('POST', '{{ route('admin.media.store') }}');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.send(formData);
}

// Modal folderu
function showCreateFolderModal() {
    document.getElementById('create-folder-modal').classList.remove('hidden');
    document.getElementById('folder_name').focus();
}

function hideCreateFolderModal() {
    document.getElementById('create-folder-modal').classList.add('hidden');
    document.getElementById('folder_name').value = '';
}

// Obsługa formularza tworzenia folderu
document.getElementById('create-folder-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            hideCreateFolderModal();
            location.reload();
        } else {
            showToast(data.error || 'Błąd podczas tworzenia folderu', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Wystąpił błąd podczas tworzenia folderu', 'error');
    });
});

// Menu funkcjonalność została zastąpiona modalem akcji

// Usuwanie elementów
function confirmDelete(itemId, itemName) {
    confirmAction(
        `Czy na pewno chcesz usunąć "${itemName}"?`,
        () => deleteItem(itemId),
        'Potwierdzenie usunięcia',
        'Usuń'
    );
}

function deleteItem(itemId) {
    fetch(`{{ url('admin/media') }}/${itemId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            location.reload();
        } else {
            showToast(data.error || 'Błąd podczas usuwania', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Wystąpił błąd podczas usuwania', 'error');
    });
}

// Obsługa klików na elementy
document.addEventListener('DOMContentLoaded', function() {
    const mediaItems = document.querySelectorAll('.media-item');

    mediaItems.forEach(item => {
        item.addEventListener('dblclick', function() {
            const type = this.dataset.type;
            const id = this.dataset.id;

            if (type === 'folder') {
                window.location.href = `{{ route('admin.media.index') }}?folder=${id}`;
            }
        });
    });
});

// Nowe funkcjonalności zarządzania dostępem
let currentItemId = null;

// Blokowanie/odblokowywanie
function blockItem(itemId, itemName) {
    const reason = prompt(`Podaj powód zablokowania "${itemName}":`);
    if (reason === null) return; // Anulowano

    fetch(`{{ url('admin/media') }}/${itemId}/block`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ reason })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            location.reload();
        } else {
            showToast(data.error || 'Błąd podczas blokowania', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Wystąpił błąd podczas blokowania', 'error');
    });
}

function unblockItem(itemId) {
    fetch(`{{ url('admin/media') }}/${itemId}/unblock`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            location.reload();
        } else {
            showToast(data.error || 'Błąd podczas odblokowywania', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Wystąpił błąd podczas odblokowywania', 'error');
    });
}

// Modal zarządzania dostępem
function showAccessModal(itemId) {
    currentItemId = itemId;
    document.getElementById('access-modal').classList.remove('hidden');
    loadAccessSettings(itemId);
    loadUsers();
}

function hideAccessModal() {
    document.getElementById('access-modal').classList.add('hidden');
    currentItemId = null;
}

function loadAccessSettings(itemId) {
    // W rzeczywistej implementacji załadowałbyśmy dane z serwera
    // Na razie ustawiamy domyślne wartości
    document.getElementById('access-level').value = 'public';
    togglePrivateUsersSection();
}

function loadUsers() {
    fetch('{{ route('admin.api.users') }}')
    .then(response => response.json())
    .then(users => {
        const select = document.getElementById('user-select');
        select.innerHTML = '<option value="">Wybierz użytkownika...</option>';

        users.forEach(user => {
            const option = document.createElement('option');
            option.value = user.id;
            option.textContent = `${user.name} (${user.email})`;
            select.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error loading users:', error);
    });
}

// Obsługa zmiany poziomu dostępu
document.getElementById('access-level').addEventListener('change', togglePrivateUsersSection);

function togglePrivateUsersSection() {
    const accessLevel = document.getElementById('access-level').value;
    const section = document.getElementById('private-users-section');

    if (accessLevel === 'private') {
        section.classList.remove('hidden');
    } else {
        section.classList.add('hidden');
    }
}

function saveAccessSettings() {
    if (!currentItemId) return;

    const accessLevel = document.getElementById('access-level').value;

    fetch(`{{ url('admin/media') }}/${currentItemId}/access`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ access_level: accessLevel })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            hideAccessModal();
            location.reload();
        } else {
            showToast(data.error || 'Błąd podczas zapisywania', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Wystąpił błąd podczas zapisywania', 'error');
    });
}

function assignUser() {
    if (!currentItemId) return;

    const userId = document.getElementById('user-select').value;
    const permission = document.getElementById('permission-select').value;

    if (!userId) {
        showToast('Wybierz użytkownika', 'error');
        return;
    }

    fetch(`{{ url('admin/media') }}/${currentItemId}/assign-user`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ user_id: userId, permission })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            document.getElementById('user-select').value = '';
            // Odśwież listę przypisanych użytkowników
        } else {
            showToast(data.error || 'Błąd podczas przypisywania użytkownika', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Wystąpił błąd podczas przypisywania użytkownika', 'error');
    });
}

function generateAccessLink() {
    if (!currentItemId) return;

    const hours = document.getElementById('link-hours').value;

    fetch(`{{ url('admin/media') }}/${currentItemId}/generate-link`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ expires_hours: hours || null })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            document.getElementById('access-link-url').value = data.link;
            document.getElementById('access-link-result').classList.remove('hidden');
        } else {
            showToast(data.error || 'Błąd podczas generowania linku', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Wystąpił błąd podczas generowania linku', 'error');
    });
}

function copyAccessLink() {
    const input = document.getElementById('access-link-url');
    input.select();
    navigator.clipboard.writeText(input.value).then(() => {
        showToast('Link skopiowany do schowka', 'success');
    });
}

function revokeAccessLink() {
    if (!currentItemId) return;

    fetch(`{{ url('admin/media') }}/${currentItemId}/revoke-link`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            document.getElementById('access-link-result').classList.add('hidden');
            document.getElementById('access-link-url').value = '';
        } else {
            showToast(data.error || 'Błąd podczas usuwania linku', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Wystąpił błąd podczas usuwania linku', 'error');
    });
}

// Modal akcji elementu
let currentActionItemId = null;

function showItemActionsModal(itemId, itemName, itemType, isBlocked) {
    currentActionItemId = itemId;
    document.getElementById('actions-item-name').textContent = itemName;

    // Ustaw ikonę w zależności od typu
    const icon = document.getElementById('actions-icon');
    if (itemType === 'folder') {
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>';
    } else {
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>';
    }

    // Stwórz akcje
    const actionsContent = document.getElementById('actions-content');
    let actions = '';

    if (itemType === 'folder') {
        actions += `
            <button onclick="openFolder(${itemId})" class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Otwórz folder
            </button>
        `;
    } else {
        actions += `
            <button onclick="viewFile(${itemId})" class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Podgląd
            </button>
            <button onclick="downloadFile(${itemId})" class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m5-2V8a2 2 0 00-2-2H7a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-2"/>
                </svg>
                Pobierz
            </button>
        `;
    }

    actions += `
        <button onclick="editItem(${itemId})" class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
            <svg class="w-5 h-5 mr-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edytuj
        </button>

        <div class="border-t border-gray-100 my-2"></div>

        <button onclick="showAccessModal(${itemId}); hideItemActionsModal()" class="w-full flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 rounded-lg">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Zarządzaj dostępem
        </button>
    `;

    if (isBlocked) {
        actions += `
            <button onclick="unblockItem(${itemId})" class="w-full flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50 rounded-lg">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Odblokuj
            </button>
        `;
    } else {
        actions += `
            <button onclick="blockItem(${itemId}, '${itemName}')" class="w-full flex items-center px-4 py-3 text-sm text-orange-600 hover:bg-orange-50 rounded-lg">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                </svg>
                Zablokuj
            </button>
        `;
    }

    actions += `
        <div class="border-t border-gray-100 my-2"></div>

        <button onclick="confirmDelete(${itemId}, '${itemName}')" class="w-full flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-lg">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Usuń
        </button>
    `;

    actionsContent.innerHTML = actions;
    document.getElementById('item-actions-modal').classList.remove('hidden');
}

function hideItemActionsModal() {
    document.getElementById('item-actions-modal').classList.add('hidden');
    currentActionItemId = null;
}

// Funkcje akcji
function openFolder(itemId) {
    hideItemActionsModal();
    window.location.href = `{{ route('admin.media.index') }}?folder=${itemId}`;
}

function viewFile(itemId) {
    hideItemActionsModal();
    window.open(`{{ url('media') }}/${itemId}`, '_blank');
}

function downloadFile(itemId) {
    hideItemActionsModal();
    window.open(`{{ url('admin/media') }}/${itemId}/download`, '_blank');
}

function editItem(itemId) {
    hideItemActionsModal();
    window.location.href = `{{ url('admin/media') }}/${itemId}/edit`;
}
</script>
@endpush
@endsection