{{-- About Hero Section --}}
<section class="relative py-20 bg-gradient-to-br from-[#003366] via-[#0056bc] to-[#4A90E2] overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                O <span class="text-[#DE234B]">Global Synlogia</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                Lider w dziedzinie innowacyjnych rozwiązań IT i implementacji sztucznej inteligencji w biznesie
            </p>
            <div class="mt-8">
                <span class="inline-block px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full text-white font-semibold">
                    🚀 Transformujemy biznes przez technologie przyszłości
                </span>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.hero-section {
    background: linear-gradient(135deg, #003366 0%, #0056bc 50%, #4A90E2 100%);
}

.animate-float-slow {
    animation: floatSlow 6s ease-in-out infinite;
}

@keyframes floatSlow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}
</style>
@endpush