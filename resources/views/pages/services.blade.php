@extends('layouts.app')

@section('title', 'Usługi - Global Synlogia')

@section('content')
<div class="min-h-screen bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Nasze Usługi</h1>
            <p class="text-xl text-gray-600">Kompleksowe rozwiązania IT dostosowane do Twoich potrzeb</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Tworzenie Stron WWW</h3>
                <p class="text-gray-600 mb-4">Nowoczesne, responsywne strony internetowe z najwyższą jakością wykonania.</p>
                <ul class="text-sm text-gray-500 space-y-1">
                    <li>• React/Next.js</li>
                    <li>• Responsive Design</li>
                    <li>• SEO Optimization</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Aplikacje Mobilne</h3>
                <p class="text-gray-600 mb-4">Natywne aplikacje mobilne dla iOS i Android z najlepszym UX.</p>
                <ul class="text-sm text-gray-500 space-y-1">
                    <li>• React Native</li>
                    <li>• Cross Platform</li>
                    <li>• App Store Ready</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Rozwiązania AI</h3>
                <p class="text-gray-600 mb-4">Sztuczna inteligencja i machine learning dla Twojego biznesu.</p>
                <ul class="text-sm text-gray-500 space-y-1">
                    <li>• Machine Learning</li>
                    <li>• Data Analysis</li>
                    <li>• Custom Models</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Usługi Chmurowe</h3>
                <p class="text-gray-600 mb-4">Migracja do chmury i zarządzanie infrastrukturą IT.</p>
                <ul class="text-sm text-gray-500 space-y-1">
                    <li>• AWS/Azure</li>
                    <li>• DevOps</li>
                    <li>• 24/7 Monitoring</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Blockchain</h3>
                <p class="text-gray-600 mb-4">Rozwiązania blockchain i smart contracts dla przyszłości.</p>
                <ul class="text-sm text-gray-500 space-y-1">
                    <li>• Smart Contracts</li>
                    <li>• Web3</li>
                    <li>• DApps</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Wsparcie Techniczne</h3>
                <p class="text-gray-600 mb-4">Kompleksowe wsparcie i utrzymanie systemów IT.</p>
                <ul class="text-sm text-gray-500 space-y-1">
                    <li>• 24/7 Support</li>
                    <li>• System Maintenance</li>
                    <li>• Technical Consulting</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection