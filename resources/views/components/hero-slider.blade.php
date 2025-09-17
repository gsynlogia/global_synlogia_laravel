{{-- Hero Slider Component --}}
<section
    class="relative h-[250px] sm:h-[300px] md:h-[350px] lg:h-[400px] overflow-hidden"
    aria-label="Slider głównych usług Global Synlogia"
    role="region"
    id="hero-slider"
>
    {{-- Animated background --}}
    <div class="absolute inset-0 bg-gray-800"></div>

    <div class="relative h-full">
        {{-- Default slides data --}}
        @php
            $slides = [
                [
                    'id' => 1,
                    'title' => 'Profesjonalne Rozwiązania IT',
                    'subtitle' => 'Global Synlogia',
                    'description' => 'Tworzymy nowoczesne aplikacje webowe i mobilne dla firm każdej wielkości.',
                    'image_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                    'button_text' => 'Poznaj nas',
                    'button_link' => '/o-firmie',
                    'alt_text' => 'Nowoczesne technologie IT',
                    'is_active' => true
                ],
                [
                    'id' => 2,
                    'title' => 'Aplikacje Webowe',
                    'subtitle' => 'React & Laravel',
                    'description' => 'Budujemy responsywne aplikacje webowe z wykorzystaniem najnowszych technologii.',
                    'image_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                    'button_text' => 'Zobacz usługi',
                    'button_link' => '/uslugi',
                    'alt_text' => 'Tworzenie aplikacji webowych',
                    'is_active' => true
                ],
                [
                    'id' => 3,
                    'title' => 'Sztuczna Inteligencja',
                    'subtitle' => 'AI & Machine Learning',
                    'description' => 'Implementujemy rozwiązania AI, chatboty i analizę danych dla Twojego biznesu.',
                    'image_url' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                    'button_text' => 'Dowiedz się więcej',
                    'button_link' => '/uslugi',
                    'alt_text' => 'Rozwiązania sztucznej inteligencji',
                    'is_active' => true
                ]
            ];
            $activeSlides = array_filter($slides, function($slide) {
                return $slide['is_active'];
            });
        @endphp

        {{-- Slides --}}
        @foreach($activeSlides as $index => $slide)
            <div
                class="hero-slide absolute inset-0 transition-all duration-1000 ease-in-out transform {{ $index === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-105' }}"
                data-slide-index="{{ $index }}"
                aria-hidden="{{ $index !== 0 ? 'true' : 'false' }}"
            >
                <div class="relative h-full">
                    <div
                        class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 {{ $index === 0 ? 'scale-100' : 'scale-110' }}"
                        style="background-image: url('{{ $slide['image_url'] }}')"
                        aria-label="{{ $slide['alt_text'] }}"
                    ></div>

                    {{-- Animated overlay --}}
                    <div class="absolute inset-0 bg-black/50"></div>

                    {{-- Floating particles effect --}}
                    <div class="absolute inset-0 opacity-30">
                        <div class="animate-float absolute top-20 left-20 w-2 h-2 bg-white rounded-full"></div>
                        <div class="animate-float absolute top-40 right-32 w-3 h-3 bg-white/70 rounded-full" style="animation-delay: 1s"></div>
                        <div class="animate-float absolute bottom-32 left-1/3 w-2 h-2 bg-white/50 rounded-full" style="animation-delay: 2s"></div>
                        <div class="animate-float absolute top-1/3 right-20 w-4 h-4 bg-white/40 rounded-full" style="animation-delay: 3s"></div>
                    </div>

                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="max-w-3xl text-white ml-8 sm:ml-12 md:ml-16 lg:ml-20 transition-all duration-1000 delay-300 {{ $index === 0 ? 'animate-slide-up' : 'opacity-0' }}" data-slide-content>
                                <div class="glass rounded-2xl p-8 backdrop-blur-sm animate-fade-scale">
                                    @if($slide['subtitle'])
                                        <h2 class="text-sm sm:text-base font-bold mb-2 text-[#124f9e] opacity-90">
                                            {{ $slide['subtitle'] }}
                                        </h2>
                                    @endif
                                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 leading-tight text-white">
                                        {{ $slide['title'] }}
                                    </h1>
                                    @if($slide['description'])
                                        <p class="text-base sm:text-lg mb-8 opacity-95 leading-relaxed max-w-2xl">
                                            {{ $slide['description'] }}
                                        </p>
                                    @endif
                                    @if($slide['button_text'] && $slide['button_link'])
                                        <a
                                            href="{{ $slide['button_link'] }}"
                                            class="inline-flex items-center gap-2 bg-[#de244b] hover:bg-red-700 px-6 py-3 text-base font-bold text-white rounded-lg transition-all duration-300 transform hover:scale-105 focus:scale-105 focus:outline-none cursor-pointer"
                                            aria-label="{{ $slide['button_text'] }} - {{ $slide['title'] }}"
                                        >
                                            {{ $slide['button_text'] }}
                                            <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Enhanced Navigation Container --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full relative">
            <button
                class="hero-prev-btn absolute left-0 top-1/2 transform -translate-y-1/2 glass hover:animate-glow text-white p-4 rounded-full transition-all duration-300 pointer-events-auto group focus:outline-none cursor-pointer animate-float"
                aria-label="Poprzedni slajd"
                type="button"
            >
                <svg
                    class="w-6 h-6 group-hover:scale-125 transition-transform"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button
                class="hero-next-btn absolute right-0 top-1/2 transform -translate-y-1/2 glass hover:animate-glow text-white p-4 rounded-full transition-all duration-300 pointer-events-auto group focus:outline-none cursor-pointer animate-float"
                aria-label="Następny slajd"
                type="button"
                style="animation-delay: 1s"
            >
                <svg
                    class="w-6 h-6 group-hover:scale-125 transition-transform"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Enhanced Dots Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-4 glass px-6 py-3 rounded-full">
        @foreach($activeSlides as $index => $slide)
            <button
                class="hero-dot w-3 h-3 rounded-full transition-all duration-500 focus:outline-none cursor-pointer transform hover:scale-150 {{ $index === 0 ? 'bg-[#de244b] scale-150' : 'bg-white/50 hover:bg-white/80' }}"
                data-slide-index="{{ $index }}"
                aria-label="Przejdź do slajdu {{ $index + 1 }}: {{ $slide['title'] }}"
                type="button"
            ></button>
        @endforeach
    </div>

    {{-- Progress bar --}}
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/20">
        <div
            class="hero-progress h-full bg-[#de244b] transition-all duration-1000"
            style="width: {{ count($activeSlides) > 0 ? (100 / count($activeSlides)) : 0 }}%"
        ></div>
    </div>

    {{-- Screen Reader Info --}}
    <div class="sr-only hero-screen-reader" aria-live="polite" aria-atomic="true">
        Aktualny slajd: 1 z {{ count($activeSlides) }}. {{ count($activeSlides) > 0 ? $activeSlides[0]['title'] : '' }}
    </div>
</section>

@push('style_hero_slider')
<style>
/* Hero Slider Animations */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes glow {
    0%, 100% { box-shadow: 0 0 20px rgba(222, 36, 75, 0.5); }
    50% { box-shadow: 0 0 40px rgba(222, 36, 75, 0.8), 0 0 60px rgba(18, 79, 158, 0.4); }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Animation classes */
.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-glow {
    animation: glow 3s ease-in-out infinite;
}

.animate-slide-up {
    animation: slideInUp 0.8s ease-out forwards;
}

.animate-fade-scale {
    animation: fadeInScale 0.6s ease-out forwards;
}

/* Glassmorphism effect */
.glass {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Hover effects */
.hero-dot:hover {
    transform: scale(1.5);
}

.hero-slide {
    transition: opacity 1s ease-in-out, transform 1s ease-in-out;
}

.hero-slide.active {
    opacity: 1;
    transform: scale(1);
}

.hero-slide.inactive {
    opacity: 0;
    transform: scale(1.05);
}
</style>
@endpush

@push('script_hero_slider')
<script>
class HeroSlider {
    constructor() {
        this.currentSlide = 0;
        this.slides = document.querySelectorAll('.hero-slide');
        this.dots = document.querySelectorAll('.hero-dot');
        this.prevBtn = document.querySelector('.hero-prev-btn');
        this.nextBtn = document.querySelector('.hero-next-btn');
        this.progressBar = document.querySelector('.hero-progress');
        this.screenReader = document.querySelector('.hero-screen-reader');
        this.autoPlayTimer = null;
        this.isLoaded = false;

        this.init();
    }

    init() {
        if (this.slides.length === 0) return;

        this.bindEvents();
        this.startAutoPlay();
        this.updateSlide(0);
        this.isLoaded = true;

        // Accessibility - keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prevSlide();
            if (e.key === 'ArrowRight') this.nextSlide();
        });
    }

    bindEvents() {
        // Navigation buttons
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.prevSlide());
        }

        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.nextSlide());
        }

        // Dots navigation
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.goToSlide(index));
        });

        // Pause auto-play on hover
        const slider = document.getElementById('hero-slider');
        if (slider) {
            slider.addEventListener('mouseenter', () => this.stopAutoPlay());
            slider.addEventListener('mouseleave', () => this.startAutoPlay());
        }
    }

    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        this.updateSlide(this.currentSlide);
    }

    prevSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        this.updateSlide(this.currentSlide);
    }

    goToSlide(index) {
        this.currentSlide = index;
        this.updateSlide(this.currentSlide);
    }

    updateSlide(index) {
        // Update slides
        this.slides.forEach((slide, i) => {
            const contentContainer = slide.querySelector('[data-slide-content]');

            if (i === index) {
                slide.classList.remove('opacity-0', 'scale-105', 'inactive');
                slide.classList.add('opacity-100', 'scale-100', 'active');
                slide.setAttribute('aria-hidden', 'false');

                if (contentContainer) {
                    contentContainer.classList.remove('opacity-0');
                    contentContainer.classList.add('animate-slide-up');
                    // Force reflow to trigger animation
                    void contentContainer.offsetHeight;
                }
            } else {
                slide.classList.remove('opacity-100', 'scale-100', 'active');
                slide.classList.add('opacity-0', 'scale-105', 'inactive');
                slide.setAttribute('aria-hidden', 'true');

                if (contentContainer) {
                    contentContainer.classList.add('opacity-0');
                    contentContainer.classList.remove('animate-slide-up');
                }
            }
        });

        // Update dots
        this.dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('bg-white/50');
                dot.classList.add('bg-[#de244b]', 'scale-150');
            } else {
                dot.classList.remove('bg-[#de244b]', 'scale-150');
                dot.classList.add('bg-white/50');
            }
        });

        // Update progress bar
        if (this.progressBar) {
            const width = ((index + 1) / this.slides.length) * 100;
            this.progressBar.style.width = `${width}%`;
        }

        // Update screen reader
        if (this.screenReader && this.slides[index]) {
            const slideTitle = this.slides[index].querySelector('h1')?.textContent || '';
            this.screenReader.textContent = `Aktualny slajd: ${index + 1} z ${this.slides.length}. ${slideTitle}`;
        }
    }

    startAutoPlay() {
        this.stopAutoPlay();
        this.autoPlayTimer = setInterval(() => {
            this.nextSlide();
        }, 7000);
    }

    stopAutoPlay() {
        if (this.autoPlayTimer) {
            clearInterval(this.autoPlayTimer);
            this.autoPlayTimer = null;
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.heroSlider = new HeroSlider();
});

// Export for Laravel
window.HeroSlider = HeroSlider;
</script>
@endpush