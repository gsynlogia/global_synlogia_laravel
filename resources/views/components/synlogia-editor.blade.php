@props([
    'name' => 'content',
    'value' => '',
    'placeholder' => 'Zacznij pisać...',
    'height' => 300,
    'disabled' => false,
    'id' => null
])

@php
    $editorId = $id ?? 'synlogia-editor-' . uniqid();
    $textareaId = $editorId . '-textarea';
@endphp

<div class="synlogia-editor border border-gray-300 rounded-lg overflow-hidden" id="{{ $editorId }}" data-editor>
    <!-- Ukryty textarea do formularzy -->
    <textarea name="{{ $name }}" id="{{ $textareaId }}" style="display: none;">{{ $value }}</textarea>

    <!-- Toolbar -->
    <div class="border-b border-gray-300 bg-gray-50 p-2 flex flex-wrap items-center gap-1">
        <!-- Heading Selector -->
        <select data-command="heading" class="mr-2 px-2 py-1 border border-gray-300 rounded text-sm" {{ $disabled ? 'disabled' : '' }}>
            <option value="p">Paragraf</option>
            <option value="h1">Nagłówek 1</option>
            <option value="h2">Nagłówek 2</option>
            <option value="h3">Nagłówek 3</option>
            <option value="h4">Nagłówek 4</option>
            <option value="h5">Nagłówek 5</option>
            <option value="h6">Nagłówek 6</option>
        </select>

        <!-- Toolbar Buttons -->
        <button type="button" data-command="undo" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Cofnij (Ctrl+Z)" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
            </svg>
        </button>

        <button type="button" data-command="redo" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Ponów (Ctrl+Shift+Z)" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10h-10a8 8 0 00-8 8v2m18-10l-6 6m6-6l-6-6"/>
            </svg>
        </button>

        <div class="w-px h-6 bg-gray-300 mx-1"></div>

        <button type="button" data-command="bold" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Pogrubienie (Ctrl+B)" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"/>
            </svg>
        </button>

        <button type="button" data-command="italic" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Kursywa (Ctrl+I)" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4l4 16m-4-8h8"/>
            </svg>
        </button>

        <button type="button" data-command="underline" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Podkreślenie (Ctrl+U)" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
        </button>

        <button type="button" data-command="strikethrough" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Przekreślenie" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="w-px h-6 bg-gray-300 mx-1"></div>

        <button type="button" data-command="justifyLeft" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wyrównaj do lewej" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 12h12M3 18h9"/>
            </svg>
        </button>

        <button type="button" data-command="justifyCenter" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wyśrodkuj" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M6 12h12M9 18h6"/>
            </svg>
        </button>

        <button type="button" data-command="justifyRight" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wyrównaj do prawej" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M9 12h12M12 18h9"/>
            </svg>
        </button>

        <button type="button" data-command="justifyFull" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wyjustuj" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 12h18M3 18h18"/>
            </svg>
        </button>

        <div class="w-px h-6 bg-gray-300 mx-1"></div>

        <button type="button" data-command="insertUnorderedList" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Lista punktowana" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <button type="button" data-command="insertOrderedList" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Lista numerowana" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <button type="button" data-command="outdent" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Zmniejsz wcięcie" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8l-4 4 4 4M3 12h18"/>
            </svg>
        </button>

        <button type="button" data-command="indent" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Zwiększ wcięcie" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4-4 4M21 12H3"/>
            </svg>
        </button>

        <div class="w-px h-6 bg-gray-300 mx-1"></div>

        <button type="button" data-action="insertLink" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wstaw link" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
            </svg>
        </button>

        <button type="button" data-action="insertImage" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wstaw obraz" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </button>

        <button type="button" data-action="insertTable" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wstaw tabelę" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18m-9 8v8m-9-8v8m18-8v8"/>
            </svg>
        </button>

        <button type="button" data-action="insertCodeBlock" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wstaw blok kodu" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
            </svg>
        </button>

        <button type="button" data-action="setTextColor" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Kolor tekstu" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 21h16"/>
            </svg>
        </button>

        <div class="w-px h-6 bg-gray-300 mx-1"></div>

        <button type="button" data-action="togglePreview" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Podgląd" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
        </button>

        <button type="button" data-action="toggleHtmlView" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Edytuj HTML" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
            </svg>
        </button>

        <button type="button" data-action="toggleFullscreen" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Pełny ekran" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
            </svg>
        </button>

        <button type="button" data-action="resetContent" class="p-2 rounded hover:bg-gray-200 transition-colors text-gray-600" title="Wyczyść zawartość" {{ $disabled ? 'disabled' : '' }}>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
        </button>
    </div>

    <!-- Editor Content -->
    <div class="relative editor-content" style="height: {{ $height }}px;">
        <!-- Preview Mode -->
        <div class="preview-mode p-4 prose max-w-none overflow-auto h-full hidden"></div>

        <!-- HTML Source Mode -->
        <textarea class="html-mode w-full h-full p-4 text-sm font-mono border-0 outline-none resize-none hidden" placeholder="<p>Edytuj kod HTML...</p>" {{ $disabled ? 'disabled' : '' }}></textarea>

        <!-- Edit Mode -->
        <div class="edit-mode p-4 outline-none h-full overflow-auto {{ $disabled ? 'bg-gray-100 cursor-not-allowed' : '' }}"
             contenteditable="{{ $disabled ? 'false' : 'true' }}"
             style="min-height: 100%;"
             data-placeholder="{{ $placeholder }}">
        </div>

        <!-- Placeholder when empty -->
        <div class="absolute top-4 left-4 text-gray-400 pointer-events-none editor-placeholder hidden">
            {{ $placeholder }}
        </div>
    </div>

    <!-- Status Bar -->
    <div class="border-t border-gray-300 bg-gray-50 px-4 py-2 text-sm text-gray-600 flex justify-between items-center">
        <div class="character-count">
            Znaki: <span>0</span>
        </div>
        <div class="text-xs">
            Synlogia Editor v1.0
        </div>
    </div>
</div>

<style>
.synlogia-editor .edit-mode:empty:before,
.synlogia-editor .edit-mode:not(:focus):before {
    content: attr(data-placeholder);
    color: #9CA3AF;
    pointer-events: none;
    position: absolute;
    display: none;
}

.synlogia-editor .edit-mode:empty:not(:focus):before {
    display: block;
}

.synlogia-editor .edit-mode {
    position: relative;
}

.synlogia-editor .edit-mode:focus {
    outline: none;
}

.synlogia-editor .edit-mode p {
    margin: 0 0 1em 0;
}

.synlogia-editor .edit-mode h1,
.synlogia-editor .edit-mode h2,
.synlogia-editor .edit-mode h3,
.synlogia-editor .edit-mode h4,
.synlogia-editor .edit-mode h5,
.synlogia-editor .edit-mode h6 {
    margin: 0.5em 0;
    font-weight: bold;
}

.synlogia-editor .edit-mode h1 { font-size: 2em; }
.synlogia-editor .edit-mode h2 { font-size: 1.5em; }
.synlogia-editor .edit-mode h3 { font-size: 1.3em; }
.synlogia-editor .edit-mode h4 { font-size: 1.1em; }
.synlogia-editor .edit-mode h5 { font-size: 1em; }
.synlogia-editor .edit-mode h6 { font-size: 0.9em; }

.synlogia-editor .edit-mode ul,
.synlogia-editor .edit-mode ol {
    margin: 1em 0;
    padding-left: 2em;
}

.synlogia-editor .edit-mode blockquote {
    margin: 1em 0;
    padding-left: 1em;
    border-left: 4px solid #ddd;
    color: #666;
}

.synlogia-editor .edit-mode table {
    border-collapse: collapse;
    width: 100%;
    margin: 1em 0;
}

.synlogia-editor .edit-mode table td,
.synlogia-editor .edit-mode table th {
    border: 1px solid #ccc;
    padding: 8px;
}

.synlogia-editor .edit-mode a {
    color: #3B82F6;
    text-decoration: underline;
}

.synlogia-editor .edit-mode img {
    max-width: 100%;
    height: auto;
}

.synlogia-editor .prose {
    max-width: none;
}

.synlogia-editor .prose p {
    margin: 0 0 1em 0;
}
</style>

<script>
(function() {
    'use strict';

    class SynlogiaEditor {
        constructor(element) {
            this.element = element;
            this.textarea = element.querySelector('textarea[name]');
            this.editMode = element.querySelector('.edit-mode');
            this.previewMode = element.querySelector('.preview-mode');
            this.htmlMode = element.querySelector('.html-mode');
            this.placeholder = element.querySelector('.editor-placeholder');
            this.characterCount = element.querySelector('.character-count span');

            this.isPreview = false;
            this.isHtmlView = false;
            this.isFullscreen = false;
            this.isUpdatingContent = false;

            this.init();
        }

        init() {
            this.setupContent();
            this.bindEvents();
            this.updateCharacterCount();
            this.updatePlaceholder();
        }

        setupContent() {
            const initialValue = this.textarea.value;
            if (initialValue) {
                const wrappedValue = initialValue.trim() && !initialValue.startsWith('<') ? `<p>${initialValue}</p>` : initialValue;
                this.editMode.innerHTML = wrappedValue || '<p><br></p>';
            } else {
                this.editMode.innerHTML = '<p><br></p>';
            }
        }

        bindEvents() {
            // Toolbar buttons
            this.element.querySelectorAll('[data-command]').forEach(button => {
                if (button.tagName === 'SELECT') {
                    button.addEventListener('change', (e) => {
                        const value = e.target.value;
                        this.setHeading(value);
                    });
                } else {
                    button.addEventListener('click', (e) => {
                        e.preventDefault();
                        const command = button.getAttribute('data-command');
                        this.executeCommand(command);
                    });
                }
            });

            this.element.querySelectorAll('[data-action]').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const action = button.getAttribute('data-action');
                    this[action]();
                });
            });

            // Editor content changes
            this.editMode.addEventListener('input', () => {
                if (!this.isUpdatingContent) {
                    this.handleContentChange();
                }
            });

            this.editMode.addEventListener('keydown', (e) => this.handleKeyDown(e));
            this.editMode.addEventListener('keypress', (e) => this.handleKeyPress(e));

            this.htmlMode.addEventListener('input', () => {
                this.handleHtmlModeChange();
            });
        }

        executeCommand(command, value = null) {
            this.editMode.focus();
            document.execCommand(command, false, value);
            this.handleContentChange();
        }

        setHeading(level) {
            if (level === 'p') {
                this.executeCommand('formatBlock', 'p');
            } else {
                this.executeCommand('formatBlock', level);
            }
        }

        handleContentChange() {
            const content = this.editMode.innerHTML;
            this.textarea.value = content;
            this.updateCharacterCount();
            this.updatePlaceholder();

            // Trigger change event
            this.textarea.dispatchEvent(new Event('change', { bubbles: true }));
        }

        handleHtmlModeChange() {
            this.textarea.value = this.htmlMode.value;
            this.updateCharacterCount();
        }

        handleKeyDown(e) {
            if (e.ctrlKey || e.metaKey) {
                switch (e.key) {
                    case 'b':
                        e.preventDefault();
                        this.executeCommand('bold');
                        break;
                    case 'i':
                        e.preventDefault();
                        this.executeCommand('italic');
                        break;
                    case 'u':
                        e.preventDefault();
                        this.executeCommand('underline');
                        break;
                    case 'z':
                        e.preventDefault();
                        if (e.shiftKey) {
                            this.executeCommand('redo');
                        } else {
                            this.executeCommand('undo');
                        }
                        break;
                }
            }
        }

        handleKeyPress(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.executeCommand('insertHTML', '<p><br></p>');
            }
        }

        insertLink() {
            const url = prompt('Wpisz URL linku:');
            if (url) {
                this.executeCommand('createLink', url);
            }
        }

        insertImage() {
            const url = prompt('Wpisz URL obrazka:');
            if (url) {
                this.executeCommand('insertImage', url);
            }
        }

        insertTable() {
            const rows = prompt('Liczba wierszy:', '3');
            const cols = prompt('Liczba kolumn:', '3');
            if (rows && cols) {
                let tableHtml = '<table border="1" style="border-collapse: collapse; width: 100%;">';
                for (let i = 0; i < parseInt(rows); i++) {
                    tableHtml += '<tr>';
                    for (let j = 0; j < parseInt(cols); j++) {
                        tableHtml += '<td style="border: 1px solid #ccc; padding: 8px;">&nbsp;</td>';
                    }
                    tableHtml += '</tr>';
                }
                tableHtml += '</table>';
                this.executeCommand('insertHTML', tableHtml);
            }
        }

        insertCodeBlock() {
            const language = prompt('Język programowania (np. javascript, python, html):', 'javascript') || 'javascript';
            const code = prompt('Wklej kod programu:', '// Wpisz swój kod tutaj') || '';

            if (code.trim()) {
                const codeHtml = `<div style="background-color: #f5f5f5; border: 1px solid #e1e1e1; border-radius: 8px; padding: 16px; margin: 16px 0; font-family: 'Courier New', Consolas, monospace; font-size: 14px; line-height: 1.5; color: #333; overflow-x: auto;">
<div style="color: #666; font-size: 12px; margin-bottom: 8px; text-transform: uppercase; font-weight: bold;">${language}</div>
<pre style="margin: 0; white-space: pre-wrap; word-wrap: break-word;"><code>${code.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</code></pre>
</div>`;

                this.executeCommand('insertHTML', codeHtml);

                setTimeout(() => {
                    this.executeCommand('insertHTML', '<p><br></p>');
                }, 50);
            }
        }

        setTextColor() {
            const color = prompt('Wpisz kolor (np. #ff0000 lub red):');
            if (color) {
                this.executeCommand('foreColor', color);
            }
        }

        togglePreview() {
            this.isPreview = !this.isPreview;
            this.updateView();
            this.updateButtonStates();
        }

        toggleHtmlView() {
            if (!this.isHtmlView) {
                // Switching TO HTML view
                this.htmlMode.value = this.editMode.innerHTML;
            }
            this.isHtmlView = !this.isHtmlView;
            this.updateView();
            this.updateButtonStates();
        }

        toggleFullscreen() {
            this.isFullscreen = !this.isFullscreen;
            if (this.isFullscreen) {
                this.element.classList.add('fixed', 'inset-0', 'z-50', 'bg-white');
                this.element.querySelector('.editor-content').style.height = 'calc(100vh - 120px)';
            } else {
                this.element.classList.remove('fixed', 'inset-0', 'z-50', 'bg-white');
                this.element.querySelector('.editor-content').style.height = '{{ $height }}px';
            }
            this.updateButtonStates();
        }

        resetContent() {
            if (confirm('Czy na pewno chcesz wyczyścić całą zawartość?')) {
                this.editMode.innerHTML = '<p><br></p>';
                this.textarea.value = '';
                this.handleContentChange();
            }
        }

        updateView() {
            this.editMode.classList.toggle('hidden', this.isPreview || this.isHtmlView);
            this.previewMode.classList.toggle('hidden', !this.isPreview);
            this.htmlMode.classList.toggle('hidden', !this.isHtmlView);

            if (this.isPreview) {
                this.previewMode.innerHTML = this.editMode.innerHTML;
            } else if (this.isHtmlView) {
                // Sync back to editor when switching from HTML view
                if (this.htmlMode.value !== this.editMode.innerHTML) {
                    this.isUpdatingContent = true;
                    this.editMode.innerHTML = this.htmlMode.value;
                    this.textarea.value = this.htmlMode.value;
                    this.isUpdatingContent = false;
                    this.updateCharacterCount();
                }
            }
        }

        updateButtonStates() {
            // Update active states for toggle buttons
            this.element.querySelector('[data-action="togglePreview"]').classList.toggle('bg-blue-100', this.isPreview);
            this.element.querySelector('[data-action="togglePreview"]').classList.toggle('text-blue-600', this.isPreview);

            this.element.querySelector('[data-action="toggleHtmlView"]').classList.toggle('bg-blue-100', this.isHtmlView);
            this.element.querySelector('[data-action="toggleHtmlView"]').classList.toggle('text-blue-600', this.isHtmlView);

            this.element.querySelector('[data-action="toggleFullscreen"]').classList.toggle('bg-blue-100', this.isFullscreen);
            this.element.querySelector('[data-action="toggleFullscreen"]').classList.toggle('text-blue-600', this.isFullscreen);
        }

        updateCharacterCount() {
            const content = this.textarea.value || '';
            const textContent = content.replace(/<[^>]*>/g, '');
            this.characterCount.textContent = textContent.length;
        }

        updatePlaceholder() {
            const isEmpty = !this.editMode.innerHTML || this.editMode.innerHTML === '<p><br></p>' || this.editMode.innerHTML === '<br>';
            this.placeholder.classList.toggle('hidden', !isEmpty || this.isPreview || this.isHtmlView);
        }

        // Public API methods
        getContent() {
            return this.editMode.innerHTML;
        }

        setContent(content) {
            this.isUpdatingContent = true;
            this.editMode.innerHTML = content;
            this.textarea.value = content;
            this.isUpdatingContent = false;
            this.updateCharacterCount();
            this.updatePlaceholder();
        }

        focus() {
            if (!this.isPreview && !this.isHtmlView) {
                this.editMode.focus();
            } else if (this.isHtmlView) {
                this.htmlMode.focus();
            }
        }

        insertText(text) {
            this.executeCommand('insertText', text);
        }
    }

    // Initialize all editors on page
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-editor]').forEach(element => {
            new SynlogiaEditor(element);
        });
    });

    // Global API for accessing editor instances
    window.SynlogiaEditor = SynlogiaEditor;
})();
</script>