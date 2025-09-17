@extends('layouts.app')

@section('title', 'Global Synlogia - Kompleksowe rozwiązania IT')

@push('styles')
    @stack('style_hero_slider')
    @stack('style_badge_slider')
    @stack('style_services_section')
    @stack('style_tech_section')
    @stack('style_services_slider')
    @stack('style_contact_section')
@endpush

@section('content')
    {{-- Hero Slider Section --}}
    @include('components.hero-slider')

    {{-- Badge Slider Section --}}
    @include('components.badge-slider')

    {{-- Services Section --}}
    @include('components.services-section')

    {{-- Tech Section --}}
    @include('components.tech-section')

    {{-- Services Slider Section --}}
    @include('components.services-slider')

    {{-- Contact Section --}}
    @include('components.contact-section')
@endsection

@push('scripts')
    @stack('script_hero_slider')
    @stack('script_badge_slider')
    @stack('script_services_section')
    @stack('script_tech_section')
    @stack('script_services_slider')
    @stack('script_contact_section')

    <!-- Main Script - only for home page -->
    <script src="{{ asset('js/home.js') }}" defer></script>
@endpush