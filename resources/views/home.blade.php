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

    <!-- Services Section - Główne Usługi -->
    <section id="services" class="py-20 bg-gray-100 relative overflow-hidden">
        <!-- Animated particles -->
        <div class="absolute inset-0 opacity-20">
            <div class="animate-float absolute top-20 left-20 w-4 h-4 bg-[#0056bc] rounded-full"></div>
            <div class="animate-float absolute top-40 right-32 w-3 h-3 bg-green-400 rounded-full" style="animation-delay: 1s;"></div>
            <div class="animate-float absolute bottom-32 left-1/3 w-2 h-2 bg-purple-400 rounded-full" style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16 animate-fade-scale">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
                    Główne Usługi
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Oferujemy kompleksowe rozwiązania IT dostosowane do potrzeb Twojego biznesu
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="services-grid">
                <!-- Services will be inserted here by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Tech Section - Technologie -->
    <section id="tech-section" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-scale">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-6">
                    Technologie
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Specjalizujemy się w najnowszych i najbardziej efektywnych technologiach
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="tech-grid">
                <!-- Technologies will be inserted here by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Component Scripts Stack -->
    @stack('script_badge_slider')

    <!-- Component Scripts -->
    <script src="{{ asset('js/components/LucideIcons.js') }}" defer></script>
    <script src="{{ asset('js/components/ServicesSection.js') }}" defer></script>
    <script src="{{ asset('js/components/TechSection.js') }}" defer></script>

    <!-- Main Script -->
    <script src="{{ asset('js/home.js') }}" defer></script>
</body>
</html>