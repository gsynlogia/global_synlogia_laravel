<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Administracyjny - Global Synlogia')</title>

    <!-- Local Fonts -->
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Admin Styles -->
    <style>
        .sidebar-gradient {
            background: linear-gradient(135deg, #124f9e 0%, #0f3f85 100%);
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(18, 79, 158, 0.15);
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }

        .admin-button {
            background: linear-gradient(135deg, #124f9e 0%, #0f3f85 100%);
            transition: all 0.3s ease;
        }

        .admin-button:hover {
            background: linear-gradient(135deg, #0f3f85 0%, #124f9e 100%);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(18, 79, 158, 0.3);
        }

        .danger-button {
            background: linear-gradient(135deg, #de244b 0%, #c21e42 100%);
        }

        .danger-button:hover {
            background: linear-gradient(135deg, #c21e42 0%, #de244b 100%);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(222, 36, 75, 0.3);
        }

        .sidebar-item {
            transition: all 0.3s ease;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #de244b;
            padding-left: 1.25rem;
        }

        .sidebar-item.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #de244b;
            padding-left: 1.25rem;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient shadow-2xl fixed h-full z-20">
            <div class="flex flex-col h-full overflow-y-auto">
                <!-- Logo -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-white font-bold text-lg">Admin Panel</h1>
                            <p class="text-white/70 text-sm">Global Synlogia</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.index') }}" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5v4m4-4v4m4-4v4"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        Użytkownicy
                    </a>

                    <!-- Roles -->
                    <a href="{{ route('admin.roles.index') }}" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Role
                    </a>

                    <!-- Permissions -->
                    <a href="{{ route('admin.permissions.index') }}" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Uprawnienia
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-white/10 my-4"></div>

                    <!-- Content Management -->
                    <div class="px-4 py-2">
                        <h3 class="text-white/70 text-xs font-semibold uppercase tracking-wider">Zarządzanie treścią</h3>
                    </div>

                    <a href="{{ route('admin.blog.index') }}" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.blog.*') ? 'bg-white/20 border-l-4 border-white' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Blog
                    </a>

                    <a href="{{ route('admin.media.index') }}" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.media.*') ? 'bg-white/20 border-l-4 border-white' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                        Media
                    </a>

                    <a href="#" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Szkolenia
                    </a>

                    <a href="#" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Slider
                    </a>

                    <a href="#" class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Usługi
                    </a>
                </nav>

                <!-- User Info -->
                <div class="p-4 border-t border-white/10">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white text-sm font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-white/70 text-xs">
                                @if(auth()->user()->isSuperuser())
                                    Super Administrator
                                @elseif(auth()->user()->isAdmin())
                                    Administrator
                                @else
                                    Użytkownik
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('dashboard') }}" target="_blank" class="text-white/70 hover:text-white transition-colors" title="Przejdź do strony głównej">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Separator -->
                    <div class="border-t border-white/10 mt-3 pt-3 -mx-4">
                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-white/70 hover:text-white text-sm flex items-center justify-between transition-colors">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                            <circle cx="9" cy="7" r="4"/>
                                            <line x1="17" x2="22" y1="8" y2="13"/>
                                            <line x1="22" x2="17" y1="8" y2="13"/>
                                        </svg>
                                    </div>
                                    Wyloguj
                                </div>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 fixed top-0 left-64 right-0 z-30">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-gray-600">@yield('page-description', 'Panel administracyjny Global Synlogia')</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Notifications -->
                            <button class="p-2 text-gray-400 hover:text-gray-600 relative">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.84 2.84A1 1 0 016.25 2h11.5a1 1 0 011.41.84l2 2A1 1 0 0121 6v11.5a1 1 0 01-.84 1.41l-2 2A1 1 0 0117 21H5.5a1 1 0 01-1.41-.84l-2-2A1 1 0 012 17V5.5a1 1 0 01.84-1.41l2-2z"/>
                                </svg>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-hidden" style="padding-top: 80px; height: calc(100vh - 80px);">
                <div class="h-full overflow-y-auto p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-4"></div>

    <!-- Modal Container -->
    <div id="modal-container"></div>

    <!-- JavaScript for Modals and Toasts -->
    <script>
        // Toast System
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            const icon = type === 'success' ?
                '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>' :
                '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>';

            toast.className = `${bgColor} text-white px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full opacity-0 flex items-center space-x-3 max-w-sm`;
            toast.innerHTML = `
                ${icon}
                <span class="font-medium">${message}</span>
                <button onclick="removeToast(this)" class="ml-4 hover:bg-white hover:bg-opacity-20 rounded p-1 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            `;

            container.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            }, 100);

            // Auto remove after 5 seconds
            setTimeout(() => removeToast(toast), 5000);
        }

        function removeToast(toast) {
            if (toast.tagName === 'BUTTON') {
                toast = toast.closest('div');
            }
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }

        // Modal System
        function showModal(title, message, confirmText = 'Potwierdź', cancelText = 'Anuluj', onConfirm = null) {
            const container = document.getElementById('modal-container');

            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 overflow-y-auto';
            modal.innerHTML = `
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeModal(this)"></div>

                    <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">${title}</h3>
                        </div>

                        <div class="mb-6">
                            <p class="text-sm text-gray-500">${message}</p>
                        </div>

                        <div class="flex space-x-3 justify-end">
                            <button type="button" onclick="closeModal(this)" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                                ${cancelText}
                            </button>
                            <button type="button" onclick="confirmModal(this)" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 transition-colors">
                                ${confirmText}
                            </button>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(modal);

            // Store callback function
            modal.confirmCallback = onConfirm;

            // Animate in
            setTimeout(() => {
                modal.querySelector('.bg-gray-500').classList.add('opacity-100');
                modal.querySelector('.bg-white').classList.add('scale-100');
            }, 10);
        }

        function closeModal(element) {
            const modal = element.closest('.fixed');
            modal.querySelector('.bg-gray-500').classList.remove('opacity-100');
            modal.querySelector('.bg-white').classList.remove('scale-100');
            setTimeout(() => modal.remove(), 200);
        }

        function confirmModal(element) {
            const modal = element.closest('.fixed');
            if (modal.confirmCallback) {
                modal.confirmCallback();
            }
            closeModal(element);
        }

        // Global function to replace confirm() with modal
        function confirmAction(message, onConfirm, title = 'Potwierdzenie', confirmText = 'Potwierdź') {
            showModal(title, message, confirmText, 'Anuluj', onConfirm);
            return false; // Always return false to prevent default form submission
        }

        // Show toasts for session messages
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        @endif

        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        @endif
    </script>

    @stack('scripts')
</body>
</html>