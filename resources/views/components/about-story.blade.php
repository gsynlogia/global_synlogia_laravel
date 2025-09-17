{{-- About Story Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Left Content --}}
            <div>
                <div class="mb-6">
                    <span class="inline-block px-4 py-2 bg-blue-50 text-[#124f9e] text-sm font-semibold rounded-lg">
                        Nasza historia
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">
                    Liderzy w implementacji <span class="text-[#124f9e]">rozwiązań AI</span>
                </h2>
                <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                    <p>
                        <strong class="text-gray-900">Global Synlogia</strong> to profesjonalna firma consultingowa specjalizująca się
                        w zaawansowanych rozwiązaniach informatycznych z wykorzystaniem sztucznej inteligencji.
                        Pomagamy przedsiębiorstwom w przeprowadzeniu skutecznej transformacji cyfrowej.
                    </p>
                    <p>
                        Nasz zespół doświadczonych inżynierów i konsultantów dostarcza rozwiązania enterprise-grade,
                        które zwiększają efektywność operacyjną i konkurencyjność naszych klientów.
                        Specjalizujemy się w implementacji systemów AI, automatyzacji procesów biznesowych
                        oraz tworzeniu nowoczesnych aplikacji webowych.
                    </p>
                    <div class="bg-white p-6 rounded-lg border-l-4 border-[#de244b] shadow-sm">
                        <p class="text-gray-800 font-medium mb-2">Misja firmy</p>
                        <p class="text-gray-600">
                            Dostarczanie profesjonalnych rozwiązań technologicznych, które umożliwiają organizacjom
                            wykorzystanie pełnego potencjału sztucznej inteligencji w codziennych operacjach biznesowych.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right Image and Certifications --}}
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Profesjonalne środowisko pracy Global Synlogia"
                         class="w-full h-64 object-cover rounded-xl mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Profesjonalne podejście</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Stosujemy sprawdzone metodologie projektowe i najwyższe standardy
                        jakości w każdym realizowanym projekcie.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-[#124f9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-sm text-gray-600 font-medium">ISO 27001</div>
                        <div class="text-xs text-gray-500">Bezpieczeństwo</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-[#de244b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="text-sm text-gray-600 font-medium">GDPR</div>
                        <div class="text-xs text-gray-500">Zgodność</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.certification-card {
    transition: all 0.3s ease;
}

.certification-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.office-image {
    transition: transform 0.3s ease;
}

.office-image:hover {
    transform: scale(1.02);
}
</style>
@endpush