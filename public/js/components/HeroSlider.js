class HeroSlider {
    constructor() {
        this.currentSlide = 0;
        this.isLoaded = false;
        this.loading = true;

        // Hardcoded slides matching the look of front
        this.slides = [
            {
                id: 1,
                title: "Nowoczesne\nTechnologie",
                subtitle: "React • Node.js • TypeScript",
                description: "Budujemy aplikacje z najnowszymi frameworkami i narzędziami",
                image_url: "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=1920&h=400&fit=crop&q=80",
                button_text: "Poznaj technologie",
                button_link: "#",
                alt_text: "Nowoczesne technologie programowania"
            },
            {
                id: 2,
                title: "Aplikacje\nWebowe",
                subtitle: "React • Next.js • Laravel",
                description: "Tworzymy responsywne i wydajne aplikacje internetowe",
                image_url: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1920&h=400&fit=crop&q=80",
                button_text: "Zobacz realizacje",
                button_link: "#",
                alt_text: "Tworzenie aplikacji webowych"
            },
            {
                id: 3,
                title: "Rozwiązania\nChmurowe",
                subtitle: "AWS • Azure • Docker",
                description: "Skalowalne rozwiązania w chmurze dla Twojego biznesu",
                image_url: "https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1920&h=400&fit=crop&q=80",
                button_text: "Dowiedz się więcej",
                button_link: "#",
                alt_text: "Usługi chmurowe i infrastruktura"
            }
        ];
    }

    init() {
        console.log('HeroSlider init started');
        this.simulateLoading();
        this.setupEventListeners();
        this.startAutoSlide();
        console.log('HeroSlider init completed');
    }

    simulateLoading() {
        console.log('simulateLoading started');
        // Simulate loading like in front
        setTimeout(() => {
            console.log('Loading timeout finished');
            this.loading = false;
            this.isLoaded = true;
            this.hideLoading();
            this.showSlider();
            this.createSlides();
            this.createDots();
            this.updateProgress();
            console.log('simulateLoading completed');
        }, 1500);
    }

    hideLoading() {
        const loading = document.getElementById('slider-loading');
        if (loading) loading.style.display = 'none';
    }

    showSlider() {
        const elements = ['slider-container', 'slider-nav', 'slider-dots', 'slider-progress'];
        elements.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.classList.remove('hidden');
        });
    }

    createSlides() {
        const container = document.getElementById('slider-container');
        if (!container) return;

        let html = '';
        this.slides.forEach((slide, index) => {
            html += `
                <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform ${
                    index === this.currentSlide ? 'opacity-100 scale-100' : 'opacity-0 scale-105'
                }" data-slide="${index}">
                    <div class="relative h-full">
                        <img src="${slide.image_url}"
                             alt="${slide.alt_text}"
                             class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-1000 ${
                                 index === this.currentSlide ? 'scale-100' : 'scale-110'
                             }"
                             loading="${index === 0 ? 'eager' : 'lazy'}" />

                        <!-- Animated overlay -->
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/40 to-transparent"></div>

                        <!-- Floating particles effect -->
                        <div class="absolute inset-0 opacity-30">
                            <div class="animate-float absolute top-20 left-20 w-2 h-2 bg-white rounded-full"></div>
                            <div class="animate-float absolute top-40 right-32 w-3 h-3 bg-white/70 rounded-full" style="animation-delay: 1s;"></div>
                            <div class="animate-float absolute bottom-32 left-1/3 w-2 h-2 bg-white/50 rounded-full" style="animation-delay: 2s;"></div>
                            <div class="animate-float absolute top-1/3 right-20 w-4 h-4 bg-white/40 rounded-full" style="animation-delay: 3s;"></div>
                        </div>

                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="max-w-3xl text-white ml-8 sm:ml-12 md:ml-16 lg:ml-20 transition-all duration-1000 delay-300 ${
                                    index === this.currentSlide ? 'animate-slide-up' : 'opacity-0'
                                }">
                                    <div class="glass rounded-2xl p-8 backdrop-blur-sm animate-fade-scale">
                                        ${slide.subtitle ? `
                                            <h2 class="text-sm sm:text-base md:text-lg font-bold mb-2 text-white opacity-90">
                                                ${slide.subtitle}
                                            </h2>
                                        ` : ''}
                                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight text-white" style="white-space: pre-line;">
                                            ${slide.title}
                                        </h1>
                                        ${slide.description ? `
                                            <p class="text-lg sm:text-xl md:text-2xl mb-8 opacity-95 leading-relaxed max-w-2xl">
                                                ${slide.description}
                                            </p>
                                        ` : ''}
                                        ${slide.button_text && slide.button_link ? `
                                            <a href="${slide.button_link}"
                                               class="inline-flex items-center gap-2 bg-[#0056bc] hover:bg-blue-800 px-8 py-4 text-lg font-bold text-white rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110 focus:outline-none cursor-pointer"
                                               aria-label="${slide.button_text} - ${slide.title}">
                                                ${slide.button_text}
                                                <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                </svg>
                                            </a>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;
    }

    createDots() {
        const container = document.getElementById('slider-dots');
        if (!container) return;

        let html = '';
        this.slides.forEach((_, index) => {
            html += `
                <button class="w-3 h-3 rounded-full transition-all duration-500 focus:outline-none cursor-pointer transform hover:scale-150 ${
                    index === this.currentSlide ? 'bg-[#0056bc] scale-150' : 'bg-white/50 hover:bg-white/80'
                }" onclick="heroSlider.goToSlide(${index})" aria-label="Przejdź do slajdu ${index + 1}"></button>
            `;
        });

        container.innerHTML = html;
    }

    setupEventListeners() {
        const prevBtn = document.getElementById('prev-slide');
        const nextBtn = document.getElementById('next-slide');

        if (prevBtn) prevBtn.addEventListener('click', () => this.prevSlide());
        if (nextBtn) nextBtn.addEventListener('click', () => this.nextSlide());

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prevSlide();
            if (e.key === 'ArrowRight') this.nextSlide();
        });
    }

    prevSlide() {
        this.currentSlide = this.currentSlide === 0 ? this.slides.length - 1 : this.currentSlide - 1;
        this.updateSlider();
    }

    nextSlide() {
        this.currentSlide = this.currentSlide === this.slides.length - 1 ? 0 : this.currentSlide + 1;
        this.updateSlider();
    }

    goToSlide(index) {
        this.currentSlide = index;
        this.updateSlider();
    }

    updateSlider() {
        this.updateSlides();
        this.updateDots();
        this.updateProgress();
    }

    updateSlides() {
        const slides = document.querySelectorAll('[data-slide]');
        slides.forEach((slide, index) => {
            const img = slide.querySelector('img');
            const content = slide.querySelector('.max-w-3xl');

            if (index === this.currentSlide) {
                slide.className = slide.className.replace('opacity-0 scale-105', 'opacity-100 scale-100');
                if (img) img.className = img.className.replace('scale-110', 'scale-100');
                if (content) content.className = content.className.replace('opacity-0', 'animate-slide-up');
            } else {
                slide.className = slide.className.replace('opacity-100 scale-100', 'opacity-0 scale-105');
                if (img) img.className = img.className.replace('scale-100', 'scale-110');
                if (content) content.className = content.className.replace('animate-slide-up', 'opacity-0');
            }
        });
    }

    updateDots() {
        const dots = document.querySelectorAll('#slider-dots button');
        dots.forEach((dot, index) => {
            if (index === this.currentSlide) {
                dot.className = dot.className.replace('bg-white/50 hover:bg-white/80', 'bg-[#0056bc] scale-150');
            } else {
                dot.className = dot.className.replace('bg-[#0056bc] scale-150', 'bg-white/50 hover:bg-white/80');
            }
        });
    }

    updateProgress() {
        const progressBar = document.querySelector('#slider-progress div');
        if (progressBar) {
            const width = ((this.currentSlide + 1) / this.slides.length) * 100;
            progressBar.style.width = `${width}%`;
        }
    }

    startAutoSlide() {
        setInterval(() => {
            this.nextSlide();
        }, 5000); // Change slide every 5 seconds
    }

    retry() {
        this.loading = true;
        this.isLoaded = false;
        document.getElementById('slider-error').classList.add('hidden');
        document.getElementById('slider-loading').style.display = 'flex';
        this.simulateLoading();
    }
}

// Export for Laravel
window.HeroSlider = HeroSlider;