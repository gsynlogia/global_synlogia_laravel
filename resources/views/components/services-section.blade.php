{{-- Services Section Container --}}
<section id="services" class="py-20 bg-gray-100 relative overflow-hidden">
    <!-- Animated particles -->
    <div class="absolute inset-0 opacity-20">
        <div class="animate-float absolute top-20 left-20 w-4 h-4 bg-[#124f9e] rounded-full"></div>
        <div class="animate-float absolute top-40 right-32 w-3 h-3 bg-[#de244b] rounded-full" style="animation-delay: 1s;"></div>
        <div class="animate-float absolute bottom-32 left-1/3 w-2 h-2 bg-[#124f9e] rounded-full" style="animation-delay: 2s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-16 animate-fade-scale">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#124f9e] mb-6">
                Główne Usługi
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Oferujemy kompleksowe rozwiązania IT dostosowane do potrzeb Twojego biznesu
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="services-grid">
            <!-- Services will be inserted here by JavaScript -->
        </div>
    </div>
</section>

@push('script_services_section')
<script>
class ServicesSection {
    constructor() {
        this.services = [
            {
                icon: "monitor",
                title: "Tworzenie Aplikacji Webowych",
                description: "Nowoczesne, responsywne aplikacje webowe dostosowane do Twoich potrzeb biznesowych. Wykorzystujemy najnowsze technologie jak React, Next.js, Node.js.",
                link: "/uslugi/tworzenie-aplikacji-webowych"
            },
            {
                icon: "globe",
                title: "Hosting i Infrastruktura",
                description: "Profesjonalne usługi hostingowe i zarządzanie infrastrukturą IT. Zapewniamy niezawodność, bezpieczeństwo i wysoką wydajność.",
                link: "/uslugi/hosting-i-infrastruktura"
            },
            {
                icon: "cloud",
                title: "Usługi Chmurowe",
                description: "Migracja do chmury, zarządzanie infrastrukturą AWS/Azure. Skalowalność i bezpieczeństwo Twoich danych.",
                link: "/uslugi/uslugi-chmurowe"
            },
            {
                icon: "smartphone",
                title: "Aplikacje Mobilne",
                description: "Rozwój aplikacji mobilnych na platformy iOS i Android. Tworzymy intuicyjne i funkcjonalne aplikacje mobilne.",
                link: "/uslugi/aplikacje-mobilne"
            },
            {
                icon: "database",
                title: "Zarządzanie Danymi",
                description: "Projektowanie baz danych, integracja systemów i przetwarzanie danych. Bezpieczne i efektywne zarządzanie informacjami.",
                link: "/uslugi/zarzadzanie-danymi"
            },
            {
                icon: "shield",
                title: "Bezpieczeństwo IT",
                description: "Audyty bezpieczeństwa, implementacja zabezpieczeń i monitoring systemów. Chronimy Twoje dane i infrastrukturę.",
                link: "/uslugi/bezpieczenstwo-it"
            }
        ];
    }

    init() {
        this.createServicesGrid();
        this.setupIntersectionObserver();
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    this.animateServices();
                }
            },
            { threshold: 0.1 }
        );

        const element = document.getElementById('services');
        if (element) observer.observe(element);
    }

    createServicesGrid() {
        const container = document.getElementById('services-grid');
        if (!container) return;

        let html = '';
        this.services.forEach((service, index) => {
            html += `
                <a href="${service.link}"
                   class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:scale-105 hover:bg-gray-50 hover:border-[#124f9e] transition-all duration-500 group cursor-pointer block shadow-lg service-card opacity-0"
                   style="animation-delay: ${index * 0.1}s">
                    <div class="flex justify-center mb-6 text-center group-hover:animate-bounce transition-all duration-300">
                        ${LucideIcons.getIcon(service.icon, "w-12 h-12 text-[#124f9e]")}
                    </div>
                    <h3 class="text-lg font-bold text-[#124f9e] mb-4 text-center group-hover:text-[#de244b] transition-colors duration-300">
                        ${service.title}
                    </h3>
                    <p class="text-gray-600 text-center leading-relaxed group-hover:text-gray-900 transition-colors duration-300 mb-4">
                        ${service.description}
                    </p>
                    <div class="text-center">
                        <span class="text-[#de244b] text-sm font-medium hover:underline transition-colors duration-300">
                            Zobacz szczegóły →
                        </span>
                    </div>
                </a>
            `;
        });

        container.innerHTML = html;
    }

    animateServices() {
        const cards = document.querySelectorAll('.service-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.remove('opacity-0');
                card.classList.add('animate-slide-up');
            }, index * 100);
        });
    }
}

// Export for Laravel
window.ServicesSection = ServicesSection;
</script>
@endpush