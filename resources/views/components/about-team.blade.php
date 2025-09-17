{{-- About Team Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-[#003366] mb-6">
                Nasz <span class="text-[#DE234B]">Zespół</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Poznaj ekspertów, którzy każdego dnia pracują nad przyszłością technologii AI i rozwiązań webowych
            </p>
        </div>

        {{-- CEO Section --}}
        <div class="mb-20">
            <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-1 text-center">
                        <div class="relative inline-block">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                 alt="Szymon Guzik - CEO & Founder"
                                 class="w-48 h-48 rounded-full mx-auto object-cover shadow-lg">
                            <div class="absolute -bottom-2 -right-2 w-16 h-16 bg-gradient-to-br from-[#DE234B] to-[#FF6B9D] rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <h3 class="text-3xl font-bold text-[#003366] mb-2">Szymon Guzik</h3>
                        <p class="text-lg text-[#DE234B] font-semibold mb-4">CEO & Founder</p>
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Wizjoner i założyciel Global Synlogia z ponad 8-letnim doświadczeniem w dziedzinie
                            zaawansowanego programowania i implementacji systemów AI. Szymon specjalizuje się w
                            tworzeniu innowacyjnych rozwiązań, które łączą najnowsze technologie sztucznej inteligencji
                            z praktycznymi zastosowaniami biznesowymi. Jego ekspertyza obejmuje full-stack development,
                            machine learning oraz architekturę systemów enterprise.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-[#003366] text-white rounded-full text-sm">AI Architecture</span>
                            <span class="px-3 py-1 bg-[#0056bc] text-white rounded-full text-sm">Full-Stack Development</span>
                            <span class="px-3 py-1 bg-[#DE234B] text-white rounded-full text-sm">Business Strategy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Team Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Team Member 1 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         alt="Anna Kowalska"
                         class="w-full h-64 object-cover">
                    <div class="absolute top-4 right-4 w-12 h-12 bg-[#DE234B] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-[#003366] mb-1">Anna Kowalska</h4>
                    <p class="text-[#DE234B] font-semibold mb-3">Lead AI Engineer</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Ekspertka w dziedzinie uczenia maszynowego i deep learning. Specjalizuje się w
                        implementacji modeli NLP i computer vision w aplikacjach biznesowych.
                    </p>
                    <div class="flex flex-wrap gap-1">
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">TensorFlow</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">PyTorch</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">NLP</span>
                    </div>
                </div>
            </div>

            {{-- Team Member 2 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         alt="Michał Nowak"
                         class="w-full h-64 object-cover">
                    <div class="absolute top-4 right-4 w-12 h-12 bg-[#0056bc] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-[#003366] mb-1">Michał Nowak</h4>
                    <p class="text-[#DE234B] font-semibold mb-3">Senior Frontend Developer</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Specjalista od nowoczesnych interfejsów użytkownika. Tworzy responsywne
                        i intuicyjne aplikacje webowe z wykorzystaniem najnowszych frameworków.
                    </p>
                    <div class="flex flex-wrap gap-1">
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">React</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">Next.js</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">TypeScript</span>
                    </div>
                </div>
            </div>

            {{-- Team Member 3 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b29c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         alt="Katarzyna Wójcik"
                         class="w-full h-64 object-cover">
                    <div class="absolute top-4 right-4 w-12 h-12 bg-[#28A745] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-[#003366] mb-1">Katarzyna Wójcik</h4>
                    <p class="text-[#DE234B] font-semibold mb-3">Digital Marketing Specialist</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Ekspertka w dziedzinie marketingu cyfrowego i SEO. Odpowiada za strategię
                        marketingową oraz budowanie obecności marki w przestrzeni cyfrowej.
                    </p>
                    <div class="flex flex-wrap gap-1">
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">SEO</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">Analytics</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">SEM</span>
                    </div>
                </div>
            </div>

            {{-- Team Member 4 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         alt="Tomasz Lewandowski"
                         class="w-full h-64 object-cover">
                    <div class="absolute top-4 right-4 w-12 h-12 bg-[#6F42C1] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                        </svg>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-[#003366] mb-1">Tomasz Lewandowski</h4>
                    <p class="text-[#DE234B] font-semibold mb-3">DevOps Engineer</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Specjalista od infrastruktury chmurowej i automatyzacji procesów.
                        Zapewnia skalowalność i niezawodność systemów produkcyjnych.
                    </p>
                    <div class="flex flex-wrap gap-1">
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">AWS</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">Docker</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">Kubernetes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.team-card {
    transition: all 0.3s ease;
}

.team-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.team-member-image {
    transition: transform 0.3s ease;
}

.team-card:hover .team-member-image {
    transform: scale(1.05);
}
</style>
@endpush