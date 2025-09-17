@extends('layouts.auth')

@section('title', 'Logowanie - Global Synlogia')

@section('content')
<!-- Back Button -->
<a href="#" class="back-button" id="backButton">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
    <span id="backText">Powrót</span>
</a>

<!-- Logo -->
<div class="logo-container">
    <img src="{{ asset('logox2.png') }}" alt="Global Synlogia">
</div>

<!-- Form Title -->
<h1 class="form-title">Zaloguj się do panelu klienta</h1>
<p class="form-subtitle">Wyślemy Ci bezpieczny link logowania na email</p>


<!-- Login Form -->
<form method="POST" action="{{ route('login.send') }}" id="loginForm">
    @csrf

    <div class="form-group">
        <label for="email" class="form-label">Adres email</label>
        <input
            id="email"
            name="email"
            type="email"
            required
            value="{{ old('email') }}"
            class="form-input @error('email') error @enderror"
            placeholder="twoj@email.com">
        @error('email')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-primary" id="submitBtn">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        <span id="btnText">Wyślij link logowania</span>
    </button>
</form>

<!-- Security Info -->
<div class="security-info">
    <div class="icon">
        <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
        </svg>
    </div>
    <div class="text">
        <strong>Bezpieczne logowanie</strong><br>
        Nie przechowujemy haseł. Link wygasa po 15 minutach.
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smart back button navigation
    const backButton = document.querySelector('#backButton');
    const backText = document.querySelector('#backText');

    // Check if there's browser history and set appropriate navigation
    if (window.history.length > 1 && document.referrer && !document.referrer.includes(window.location.hostname + '/auth/')) {
        // User came from somewhere else in our system
        backButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.history.back();
        });

        // Try to get the previous page title for better UX
        if (document.referrer.includes(window.location.hostname)) {
            const referrerPath = new URL(document.referrer).pathname;
            if (referrerPath === '/') {
                backText.textContent = 'Powrót do strony głównej';
            } else if (referrerPath === '/uslugi') {
                backText.textContent = 'Powrót do usług';
            } else if (referrerPath === '/blog') {
                backText.textContent = 'Powrót do bloga';
            } else if (referrerPath === '/kontakt') {
                backText.textContent = 'Powrót do kontaktu';
            } else if (referrerPath === '/o-firmie') {
                backText.textContent = 'Powrót do o firmie';
            } else {
                backText.textContent = 'Powrót';
            }
        }
    } else {
        // User came directly or from external source - go to homepage
        backButton.href = '/';
        backText.textContent = 'Strona główna';
    }

    // Add loading state to form submission
    const form = document.querySelector('#loginForm');
    const submitButton = document.querySelector('#submitBtn');
    const btnText = document.querySelector('#btnText');

    form.addEventListener('submit', function() {
        submitButton.disabled = true;
        btnText.innerHTML = 'Wysyłanie...';

        // Add spinner
        const spinner = document.createElement('svg');
        spinner.className = 'w-5 h-5 spinner';
        spinner.setAttribute('fill', 'none');
        spinner.setAttribute('stroke', 'currentColor');
        spinner.setAttribute('viewBox', '0 0 24 24');
        spinner.innerHTML = '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>';

        // Replace the email icon with spinner
        const emailIcon = submitButton.querySelector('svg');
        emailIcon.replaceWith(spinner);
    });
});
</script>
@endpush