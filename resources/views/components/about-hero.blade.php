{{-- About Hero Section --}}
<section class="relative py-24 bg-gray-50 overflow-hidden">
    {{-- Professional Background Pattern --}}
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-50 opacity-30"></div>
        <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-gray-100 opacity-50"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- Left Content --}}
            <div>
                <div class="mb-6">
                    <span class="inline-block px-4 py-2 bg-blue-50 text-[#124f9e] text-sm font-semibold rounded-lg">
                        O firmie
                    </span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 leading-tight">
                    <span class="text-[#124f9e]">Global Synlogia</span><br>
                    Eksperci w dziedzinie AI
                </h1>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Profesjonalne rozwiązania informatyczne i implementacja sztucznej inteligencji
                    dla przedsiębiorstw dążących do cyfrowej transformacji.
                </p>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-[#124f9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Certyfikowani specjaliści</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-[#de244b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Nowoczesne technologie</span>
                    </div>
                </div>
            </div>

            {{-- Right Statistics --}}
            <div class="grid grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="text-2xl font-bold text-[#124f9e] mb-2">Projekty AI</div>
                    <div class="text-gray-600 text-sm font-medium">Zaawansowane wdrożenia</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="text-2xl font-bold text-[#de244b] mb-2">Satysfakcja</div>
                    <div class="text-gray-600 text-sm font-medium">Zadowolenie klientów</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="text-2xl font-bold text-[#124f9e] mb-2">Technologie</div>
                    <div class="text-gray-600 text-sm font-medium">Nowoczesne rozwiązania</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="text-2xl font-bold text-[#de244b] mb-2">Wsparcie</div>
                    <div class="text-gray-600 text-sm font-medium">Ciągła opieka techniczna</div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.stats-card {
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    transition: all 0.3s ease;
}

.feature-icon:hover {
    transform: scale(1.05);
}
</style>
@endpush