<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Global Synlogia Laravel</title>

    <!-- Local Fonts -->
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <!-- Component Styles Stack -->
    @stack('style_blue_info_banner_top')
    @stack('style_navigation_header')
    @stack('style_badge_slider')
</head>
<body class="min-h-screen">
    @include('components.info-banner')
    @include('components.navigation')
    @include('components.badge-slider')
    @include('components.services-section')
    @include('components.tech-section')
    @include('components.services-slider')

    <!-- Component Scripts Stack -->
    @stack('script_badge_slider')
    @stack('script_services_section')
    @stack('script_tech_section')
    @stack('script_services_slider')

    <!-- Component Scripts -->
    <script src="{{ asset('js/components/LucideIcons.js') }}" defer></script>

    <!-- Main Script -->
    <script src="{{ asset('js/home.js') }}" defer></script>
</body>
</html>