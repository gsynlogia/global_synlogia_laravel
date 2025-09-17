{{-- About Story Section --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Left Content --}}
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-[#003366] mb-8">
                    Nasza <span class="text-[#DE234B]">Historia</span>
                </h2>
                <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                    <p>
                        <strong>Global Synlogia</strong> powstała z wizji przekształcenia sposobu, w jaki firmy wykorzystują technologie.
                        Specjalizujemy się w tworzeniu zaawansowanych aplikacji webowych z integracją sztucznej inteligencji,
                        które rewolucjonizują procesy biznesowe naszych klientów.
                    </p>
                    <p>
                        Jako eksperci w dziedzinie programowania i technologii AI, dostarczamy rozwiązania, które nie tylko
                        odpowiadają na dzisiejsze potrzeby, ale również przygotowują organizacje na wyzwania przyszłości.
                        Nasze doświadczenie obejmuje szerokie spektrum technologii - od nowoczesnych frameworków webowych
                        po zaawansowane systemy uczenia maszynowego.
                    </p>
                    <p>
                        <strong>Misja firmy</strong> to democratyzacja dostępu do najnowszych technologii AI,
                        umożliwiając firmom każdej wielkości korzystanie z potęgi sztucznej inteligencji
                        w ich codziennych operacjach.
                    </p>
                </div>
            </div>

            {{-- Right Stats --}}
            <div class="grid grid-cols-2 gap-8">
                <div class="text-center p-6 bg-gradient-to-br from-[#003366] to-[#0056bc] rounded-2xl text-white">
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-sm uppercase tracking-wider">Projektów AI</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-[#DE234B] to-[#FF6B9D] rounded-2xl text-white">
                    <div class="text-4xl font-bold mb-2">15+</div>
                    <div class="text-sm uppercase tracking-wider">Technologii</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-[#4A90E2] to-[#7B68EE] rounded-2xl text-white">
                    <div class="text-4xl font-bold mb-2">100%</div>
                    <div class="text-sm uppercase tracking-wider">Satysfakcja</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-[#28A745] to-[#20C997] rounded-2xl text-white">
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <div class="text-sm uppercase tracking-wider">Wsparcie</div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.stats-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}
</style>
@endpush