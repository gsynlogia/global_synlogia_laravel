@extends('layouts.app')

@section('title', 'O firmie - Global Synlogia | Lider w rozwiązaniach AI i aplikacjach webowych')

@push('styles')
    @stack('style_about_hero')
    @stack('style_about_story')
    @stack('style_about_team')
    @stack('style_about_values')
@endpush

@section('content')
    {{-- About Hero Section --}}
    @include('components.about-hero')

    {{-- About Story Section --}}
    @include('components.about-story')

    {{-- About Team Section --}}
    @include('components.about-team')

    {{-- About Values Section --}}
    @include('components.about-values')
@endsection

@push('scripts')
    @stack('script_about_hero')
    @stack('script_about_story')
    @stack('script_about_team')
    @stack('script_about_values')
@endpush