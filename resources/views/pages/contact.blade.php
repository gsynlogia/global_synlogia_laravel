@extends('layouts.app')

@section('title', 'Kontakt - Global Synlogia')

@push('styles')
    @stack('style_contact_hero')
    @stack('style_contact_cards')
    @stack('style_contact_form_section')
    @stack('style_contact_faq')
@endpush

@section('content')
    {{-- Contact Hero Section --}}
    @include('components.contact-hero')

    {{-- Contact Info Cards --}}
    @include('components.contact-cards')

    {{-- Contact Form and Company Info Section --}}
    @include('components.contact-form-section')

    {{-- FAQ Section --}}
    @include('components.contact-faq')
@endsection

@push('scripts')
    @stack('script_contact_hero')
    @stack('script_contact_cards')
    @stack('script_contact_form_section')
    @stack('script_contact_faq')
@endpush