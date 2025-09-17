{{-- Services Slider Container --}}
<section id="services-slider" class="py-20 bg-gray-100 relative overflow-hidden">
    <!-- Animated background particles -->
    <div class="absolute inset-0 opacity-10">
        <div class="animate-float absolute top-10 left-10 w-4 h-4 bg-[#0056bc] rounded-full"></div>
        <div class="animate-float absolute top-20 right-20 w-6 h-6 bg-green-400 rounded-full" style="animation-delay: 1s;"></div>
        <div class="animate-float absolute bottom-20 left-1/4 w-3 h-3 bg-purple-400 rounded-full" style="animation-delay: 2s;"></div>
        <div class="animate-float absolute top-1/3 right-1/3 w-5 h-5 bg-orange-400 rounded-full" style="animation-delay: 3s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-scale">
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-800 mb-6">
                Nasze Usługi
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Kompleksowe rozwiązania IT dostosowane do Twoich potrzeb
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12" id="services-slider-grid">
            <!-- Services will be inserted here by JavaScript -->
        </div>

        <!-- Navigation Dots -->
        <div class="flex justify-center space-x-4" id="services-slider-dots">
            <!-- Dots will be inserted here by JavaScript -->
        </div>
    </div>
</section>

@push('script_services_slider')
<script>
class ServicesSlider {
    constructor() {
        this.currentService = 0;
        this.isVisible = false;
        this.autoSlideTimer = null;
        this.services = [
            {
                id: 1,
                icon: "rocket",
                title: "Web Development",
                description: "Nowoczesne strony i aplikacje webowe",
                features: ["React/Next.js", "Responsive Design", "SEO Optimized", "Fast Loading"],
                link: "/uslugi/tworzenie-aplikacji-webowych"
            },
            {
                id: 2,
                icon: "zap",
                title: "Mobile Apps",
                description: "Aplikacje mobilne iOS i Android",
                features: ["React Native", "Native Performance", "App Store Ready", "Cross Platform"],
                link: "/uslugi/aplikacje-mobilne"
            },
            {
                id: 3,
                icon: "database",
                title: "Data Management",
                description: "Zarządzanie danymi i analityka",
                features: ["Database Design", "Data Integration", "BI Analytics", "ETL Processes"],
                link: "/uslugi/zarzadzanie-danymi"
            },
            {
                id: 4,
                icon: "cloud",
                title: "Cloud Services",
                description: "Infrastruktura i usługi chmurowe",
                features: ["AWS/Azure", "DevOps", "Scalability", "24/7 Monitoring"],
                link: "/uslugi/uslugi-chmurowe"
            },
            {
                id: 5,
                icon: "shield-check",
                title: "Security",
                description: "Bezpieczeństwo IT i monitoring",
                features: ["Security Audit", "24/7 Monitoring", "Compliance", "Incident Response"],
                link: "/uslugi/bezpieczenstwo-it"
            }
        ];
    }

    init() {
        this.createServicesGrid();
        this.createNavigationDots();
        this.setupIntersectionObserver();
        this.startAutoSlide();
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    this.isVisible = true;
                    this.animateServices();
                }
            },
            { threshold: 0.1 }
        );

        const element = document.getElementById('services-slider');
        if (element) observer.observe(element);
    }

    createServicesGrid() {
        const container = document.getElementById('services-slider-grid');
        if (!container) return;

        let html = '';
        this.services.forEach((service, index) => {
            html += `
                <div class="service-slider-card bg-white border-2 rounded-2xl p-6 shadow-lg transition-all duration-700 cursor-pointer group hover:scale-105 hover:shadow-xl border-gray-200 opacity-0"
                     style="animation-delay: ${index * 0.1}s"
                     data-service-index="${index}">
                    <div class="mb-4 group-hover:animate-bounce">
                        ${LucideIcons.getIcon(service.icon, "w-16 h-16 text-[#0056bc] mx-auto")}
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-[#0056bc] transition-colors duration-300">
                        ${service.title}
                    </h3>
                    <p class="text-gray-600 mb-4 leading-relaxed group-hover:text-gray-800 transition-colors duration-300">
                        ${service.description}
                    </p>

                    <div class="space-y-2 mb-6">
                        ${service.features.map((feature, idx) => `
                            <div class="flex items-center text-sm text-gray-500 group-hover:text-gray-700 transition-colors duration-300"
                                 style="animation-delay: ${idx * 0.1}s">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                ${feature}
                            </div>
                        `).join('')}
                    </div>

                    <div class="flex justify-center">
                        <button class="w-full bg-[#0056bc] hover:bg-blue-800 px-6 py-3 rounded-full text-white font-bold transition-all duration-300 group-hover:scale-110">
                            Zamawiam
                        </button>
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;
        this.attachCardEvents();
    }

    createNavigationDots() {
        const container = document.getElementById('services-slider-dots');
        if (!container) return;

        let html = '';
        this.services.forEach((_, index) => {
            html += `
                <button class="service-dot w-4 h-4 rounded-full transition-all duration-500 hover:scale-125 cursor-pointer bg-gray-300 hover:bg-gray-500"
                        data-dot-index="${index}">
                </button>
            `;
        });

        container.innerHTML = html;
        this.attachDotEvents();
    }

    attachCardEvents() {
        const cards = document.querySelectorAll('.service-slider-card');
        cards.forEach(card => {
            card.addEventListener('click', () => {
                const index = parseInt(card.dataset.serviceIndex);
                this.setActiveService(index);
            });
        });
    }

    attachDotEvents() {
        const dots = document.querySelectorAll('.service-dot');
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const index = parseInt(dot.dataset.dotIndex);
                this.setActiveService(index);
            });
        });
    }

    setActiveService(index) {
        this.currentService = index;
        this.updateActiveStates();
        this.restartAutoSlide();
    }

    updateActiveStates() {
        // Update cards
        const cards = document.querySelectorAll('.service-slider-card');
        cards.forEach((card, index) => {
            if (index === this.currentService) {
                card.classList.remove('border-gray-200');
                card.classList.add('border-[#0056bc]', 'scale-105', 'shadow-2xl');
            } else {
                card.classList.remove('border-[#0056bc]', 'scale-105', 'shadow-2xl');
                card.classList.add('border-gray-200');
            }
        });

        // Update dots
        const dots = document.querySelectorAll('.service-dot');
        dots.forEach((dot, index) => {
            if (index === this.currentService) {
                dot.classList.remove('bg-gray-300');
                dot.classList.add('bg-[#0056bc]', 'scale-125');
            } else {
                dot.classList.remove('bg-[#0056bc]', 'scale-125');
                dot.classList.add('bg-gray-300');
            }
        });
    }

    animateServices() {
        if (!this.isVisible) return;

        const cards = document.querySelectorAll('.service-slider-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.remove('opacity-0');
                card.classList.add('animate-slide-up');
            }, index * 100);
        });

        // Set initial active state after animation
        setTimeout(() => {
            this.updateActiveStates();
        }, 500);
    }

    startAutoSlide() {
        this.autoSlideTimer = setInterval(() => {
            this.currentService = (this.currentService + 1) % this.services.length;
            this.updateActiveStates();
        }, 4000);
    }

    restartAutoSlide() {
        if (this.autoSlideTimer) {
            clearInterval(this.autoSlideTimer);
        }
        this.startAutoSlide();
    }
}

// Export for Laravel
window.ServicesSlider = ServicesSlider;
</script>
@endpush