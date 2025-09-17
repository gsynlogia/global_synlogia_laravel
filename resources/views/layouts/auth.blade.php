<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Global Synlogia')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    @stack('styles')

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
        }

        .auth-left {
            flex: 1;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-right {
            flex: 1;
            background-image: url('{{ asset('login-bg-new.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }


        .auth-form-container {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            padding: 3rem;
            border: 1px solid #e5e7eb;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            transition: color 0.2s ease;
        }

        .back-button:hover {
            color: #124f9e;
        }

        .back-button svg {
            width: 1rem;
            height: 1rem;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-container img {
            height: 60px;
            width: auto;
            margin: 0 auto;
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #124f9e;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #6b7280;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: #ffffff;
        }

        .form-input:focus {
            outline: none;
            border-color: #124f9e;
            box-shadow: 0 0 0 3px rgba(18, 79, 158, 0.1);
        }

        .form-input.error {
            border-color: #ef4444;
        }

        .form-error {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.5rem;
        }

        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #de244b 0%, #b91c3c 100%);
            color: #ffffff;
            border: none;
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(222, 36, 75, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .security-info {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 1rem;
            margin: 1.5rem 0;
            text-align: center;
        }

        .security-info .icon {
            color: #10b981;
            margin-bottom: 0.5rem;
        }

        .security-info .text {
            color: #64748b;
            font-size: 0.75rem;
            line-height: 1.4;
        }

        .back-link {
            text-align: center;
            margin-top: 2rem;
        }

        .back-link a {
            color: #de244b;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .back-link a:hover {
            color: #124f9e;
        }


        /* Mobile responsiveness */
        @media (max-width: 1024px) {
            .auth-container {
                flex-direction: column;
            }

            .auth-right {
                display: none;
            }

            .auth-left {
                min-height: 100vh;
                padding: 1rem;
            }

            .auth-form-container {
                padding: 2rem;
                border: none;
            }
        }

        /* Loading animation */
        .spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Fade in animation */
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="auth-container">
        <!-- Left side - Form -->
        <div class="auth-left">
            <div class="auth-form-container fade-in">
                @yield('content')
            </div>
        </div>

        <!-- Right side - Background image -->
        <div class="auth-right"></div>
    </div>

    <!-- Toast Notifications for Auth -->
    <div id="toast-container" class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50 space-y-2"></div>

    <!-- Scripts -->
    @stack('scripts')

    <script>
        // Toast notification system for auth
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

        // Add fade-in animation and handle flash messages
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.auth-form-container');
            if (container) {
                container.style.animationDelay = '0.1s';
            }

            // Show toast for flash messages
            @if(session('success'))
                showToast('{{ session('success') }}', 'success');
            @endif

            @if(session('error'))
                showToast('{{ session('error') }}', 'error');
            @endif
        });
    </script>
</body>
</html>