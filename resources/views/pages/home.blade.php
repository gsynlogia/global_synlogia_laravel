@extends('layouts.app')

@section('title', 'Global Synlogia - Kompleksowe rozwiązania IT')

@push('styles')
    @stack('style_badge_slider')
    @stack('style_services_section')
    @stack('style_tech_section')
    @stack('style_services_slider')
    @stack('style_contact_section')
@endpush

@section('content')
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
    @stack('script_badge_slider')
    @stack('script_services_section')
    @stack('script_tech_section')
    @stack('script_services_slider')
    @stack('script_contact_section')
@endpush