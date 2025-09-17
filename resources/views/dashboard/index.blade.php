@extends('layouts.app')

@section('title', 'Panel Klienta - Global Synlogia')

@section('content')
<div class="min-h-screen bg-gray-50">


    {{-- Dashboard Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Welcome Card --}}
            <div class="md:col-span-2 bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-[#124f9e] rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-[#124f9e]">Witaj w panelu klienta!</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Tutaj znajdziesz informacje o swoich projektach i możesz skontaktować się z naszym zespołem.
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-[#124f9e]">0</div>
                            <div class="text-sm text-gray-600">Aktywne projekty</div>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-[#de244b]">0</div>
                            <div class="text-sm text-gray-600">Wiadomości</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-[#124f9e] mb-4">Szybkie akcje</h3>
                    <div class="space-y-3">
                        <a href="#" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-[#124f9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900">Nowy projekt</span>
                        </a>

                        <a href="/kontakt" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-[#de244b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900">Kontakt</span>
                        </a>

                        <a href="/uslugi" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-[#124f9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900">Nasze usługi</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="mt-8">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-[#124f9e]">Ostatnia aktywność</h3>
                </div>
                <div class="p-6">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h3 class="mt-4 text-sm font-medium text-gray-900">Brak aktywności</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Gdy rozpoczniemy pracę nad Twoimi projektami, aktywność będzie wyświetlana tutaj.
                        </p>
                        <div class="mt-6">
                            <a href="/kontakt" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#de244b] hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#de244b]">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Rozpocznij projekt
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="mt-8">
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-[#124f9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-medium text-[#124f9e]">Potrzebujesz pomocy?</h4>
                        <p class="text-sm text-gray-600 mt-1">
                            Skontaktuj się z nami: <a href="mailto:kontakt@globalsynlogia.com" class="text-[#de244b] hover:text-[#124f9e]">kontakt@globalsynlogia.com</a> lub <a href="tel:+48663583950" class="text-[#de244b] hover:text-[#124f9e]">+48 663 583 950</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.dashboard-card {
    transition: all 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.quick-action:hover {
    background-color: #f9fafb;
}

.fade-in {
    animation: fadeIn 0.6s ease-out forwards;
    opacity: 0;
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

.fade-in:nth-child(1) { animation-delay: 0.1s; }
.fade-in:nth-child(2) { animation-delay: 0.2s; }
.fade-in:nth-child(3) { animation-delay: 0.3s; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to dashboard cards
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.classList.add('fade-in');
        card.style.animationDelay = `${index * 0.1}s`;
    });

});
</script>
@endpush