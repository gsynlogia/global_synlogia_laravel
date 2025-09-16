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

    <!-- Component Scripts -->
    <script src="{{ asset('js/components/LucideIcons.js') }}" defer></script>

    <!-- Main Script -->
    <script src="{{ asset('js/home.js') }}" defer></script>
</body>
</html>