<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Global Synlogia Laravel')</title>

    <!-- Local Fonts -->
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <!-- Component Styles Stack -->
    @stack('style_header')
    @stack('styles')
    @yield('styles')
</head>
<body class="min-h-screen">
    {{-- Header Component (Info Banner + Navigation) --}}
    @include('components.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer Component --}}
    @include('components.footer')

    <!-- Component Scripts Stack -->
    @stack('script_header')
    @stack('script_footer')
    @stack('scripts')
    @yield('scripts')

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50 space-y-2"></div>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-[#de244b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-gray-900">Potwierdzenie wylogowania</h3>
                    </div>
                </div>
                <div class="mb-6">
                    <p class="text-sm text-gray-600">Czy na pewno chcesz się wylogować? Zostaniesz przekierowany na stronę główną.</p>
                </div>
                <div class="flex justify-end space-x-3">
                    <button id="cancel-logout" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#124f9e]">
                        Anuluj
                    </button>
                    <button id="confirm-logout" class="px-4 py-2 text-sm font-medium text-white bg-[#de244b] border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#de244b]">
                        Wyloguj się
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toast notification system
        function showToast(message, type = 'success', duration = 3000) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            let borderColor, iconColor, textColor, icon;

            if (type === 'success') {
                borderColor = 'border-green-500';
                iconColor = 'text-green-500';
                textColor = 'text-green-700';
                icon = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>';
            } else if (type === 'error') {
                borderColor = 'border-red-500';
                iconColor = 'text-red-500';
                textColor = 'text-red-700';
                icon = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>';
            } else {
                borderColor = 'border-yellow-500';
                iconColor = 'text-yellow-500';
                textColor = 'text-yellow-700';
                icon = '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>';
            }

            toast.className = `bg-white ${borderColor} border-l-4 px-6 py-4 rounded-lg shadow-lg transform -translate-y-full opacity-0 transition-all duration-300 ease-out max-w-md`;
            toast.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 ${iconColor}" fill="currentColor" viewBox="0 0 20 20">
                        ${icon}
                    </svg>
                    <span class="${textColor} font-medium">${message}</span>
                </div>
            `;

            container.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('-translate-y-full', 'opacity-0');
            }, 10);

            // Auto remove
            setTimeout(() => {
                toast.classList.add('-translate-y-full', 'opacity-0');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, duration);
        }

        // Logout modal system
        document.addEventListener('DOMContentLoaded', function() {
            const logoutModal = document.getElementById('logout-modal');
            const cancelBtn = document.getElementById('cancel-logout');
            const confirmBtn = document.getElementById('confirm-logout');
            let logoutForm = null;

            // Handle logout button clicks
            document.addEventListener('click', function(e) {
                if (e.target.closest('button[type="submit"]') && e.target.closest('form[action*="logout"]')) {
                    e.preventDefault();
                    logoutForm = e.target.closest('form');
                    logoutModal.classList.remove('hidden');
                }
            });

            // Cancel logout
            cancelBtn.addEventListener('click', function() {
                logoutModal.classList.add('hidden');
                logoutForm = null;
            });

            // Confirm logout
            confirmBtn.addEventListener('click', function() {
                if (logoutForm) {
                    logoutForm.submit();
                }
            });

            // Close modal on background click
            logoutModal.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    logoutModal.classList.add('hidden');
                    logoutForm = null;
                }
            });

            // Show toast for flash messages
            @if(session('success'))
                showToast('{{ session('success') }}', 'success');
            @endif

            @if(session('error'))
                showToast('{{ session('error') }}', 'error');
            @endif
        });
    </script>

    <!-- Component Scripts -->
    <script src="{{ asset('js/components/LucideIcons.js') }}" defer></script>
</body>
</html>