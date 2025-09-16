{{-- Badge Slider Container --}}
<div id="badge-slider-container"></div>

@push('style_badge_slider')
<style>
    /* Badge Slider Animations */
    @keyframes scrollLeft {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(-100%);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-scroll-left {
        animation: scrollLeft 45s linear infinite;
    }

    /* fadeInScale animation for cards */
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

    .animate-fade-scale {
        animation: fadeInScale 0.6s ease-out forwards;
    }
</style>
@endpush

@push('script_badge_slider')
<script>
class BadgeSlider {
    constructor() {
        this.isVisible = false;
        this.technologies = [
            // Frontend
            { id: 1, name: "React", icon: 'code', color: "#0056bc", category: "Frontend" },
            { id: 2, name: "Next.js", icon: 'code', color: "#0056bc", category: "Frontend" },
            { id: 3, name: "Vue.js", icon: 'leaf', color: "#0056bc", category: "Frontend" },
            { id: 4, name: "TypeScript", icon: 'code', color: "#0056bc", category: "Frontend" },

            // Backend
            { id: 5, name: "Node.js", icon: 'server', color: "#0056bc", category: "Backend" },
            { id: 6, name: "Python", icon: 'pen-tool', color: "#0056bc", category: "Backend" },
            { id: 7, name: "PHP", icon: 'code-xml', color: "#0056bc", category: "Backend" },
            { id: 8, name: "Java", icon: 'coffee', color: "#0056bc", category: "Backend" },

            // Database
            { id: 9, name: "MongoDB", icon: 'leaf', color: "#0056bc", category: "Database" },
            { id: 10, name: "PostgreSQL", icon: 'database', color: "#0056bc", category: "Database" },
            { id: 11, name: "MySQL", icon: 'database', color: "#0056bc", category: "Database" },
            { id: 12, name: "Redis", icon: 'box', color: "#0056bc", category: "Database" },

            // Cloud
            { id: 13, name: "AWS", icon: 'cloud', color: "#0056bc", category: "Cloud" },
            { id: 14, name: "Azure", icon: 'cloud', color: "#0056bc", category: "Cloud" },
            { id: 15, name: "Docker", icon: 'container', color: "#0056bc", category: "Cloud" },
            { id: 16, name: "Kubernetes", icon: 'settings', color: "#0056bc", category: "Cloud" },

            // AI/ML
            { id: 17, name: "TensorFlow", icon: 'brain', color: "#0056bc", category: "AI/ML" },
            { id: 18, name: "OpenAI", icon: 'bot', color: "#0056bc", category: "AI/ML" },
            { id: 19, name: "Pytorch", icon: 'flame', color: "#0056bc", category: "AI/ML" },

            // Mobile
            { id: 20, name: "React Native", icon: 'smartphone', color: "#0056bc", category: "Mobile" },
            { id: 21, name: "Flutter", icon: 'layers', color: "#0056bc", category: "Mobile" },
            { id: 22, name: "Swift", icon: 'apple', color: "#0056bc", category: "Mobile" }
        ];
    }

    init() {
        this.createSliderStructure();
        this.setupIntersectionObserver();
        this.createFloatingParticles();
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    this.isVisible = true;
                    this.animateCards();
                }
            },
            { threshold: 0.1 }
        );

        const element = document.getElementById('badge-slider');
        if (element) observer.observe(element);
    }

    createSliderStructure() {
        const container = document.getElementById('badge-slider-container');
        if (!container) return;

        // Duplicate badges for seamless scrolling
        const duplicatedBadges = [...this.technologies, ...this.technologies];

        let html = `
            <section id="badge-slider" class="py-8 bg-white overflow-hidden relative">
                <div class="absolute inset-0 opacity-10" id="floating-particles"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="relative">
                        <div class="flex overflow-hidden">
                            <div class="flex animate-scroll-left" style="width: calc(200px * 22); animation: scrollLeft 45s linear infinite">
        `;

        // Reverse the badges like in front
        [...duplicatedBadges].reverse().forEach((tech, index) => {
            html += `
                <a href="#"
                   class="flex-shrink-0 mx-4 bg-white border-2 border-[#0056bc] rounded-2xl p-6 min-w-[180px] group hover:scale-110 hover:bg-gray-50 hover:border-[#de244b] transition-all duration-300 shadow-lg cursor-pointer block opacity-0 tech-card"
                   style="animation-delay: ${(index % 22) * 0.05}s">
                    <div class="text-center">
                        <div class="mb-3 group-hover:animate-bounce">
                            ${this.getIcon(tech.icon)}
                        </div>
                        <h3 class="text-gray-900 font-bold text-lg mb-1 group-hover:text-[#de244b] transition-colors duration-300">${tech.name}</h3>
                        <p class="text-gray-600 text-xs font-medium uppercase tracking-wider group-hover:text-[#de244b] transition-colors duration-300">${tech.category}</p>
                    </div>
                </a>
            `;
        });

        html += `
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `;

        container.innerHTML = html;
    }

    getIcon(iconName) {
        const icons = {
            'apple': '<path d="M12 6.528V3a1 1 0 0 1 1-1h0"></path><path d="M18.237 21A15 15 0 0 0 22 11a6 6 0 0 0-10-4.472A6 6 0 0 0 2 11a15.1 15.1 0 0 0 3.763 10 3 3 0 0 0 3.648.648 5.5 5.5 0 0 1 5.178 0A3 3 0 0 0 18.237 21"></path>',
            'layers': '<path d="M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z"></path><path d="M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12"></path><path d="M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17"></path>',
            'smartphone': '<rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect><path d="M12 18h.01"></path>',
            'flame': '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"></path>',
            'bot': '<path d="M12 8V4H8"></path><rect width="16" height="12" x="4" y="8" rx="2"></rect><path d="M2 14h2"></path><path d="M20 14h2"></path><path d="M15 13v2"></path><path d="M9 13v2"></path>',
            'brain': '<path d="M12 18V5"></path><path d="M15 13a4.17 4.17 0 0 1-3-4 4.17 4.17 0 0 1-3 4"></path><path d="M17.598 6.5A3 3 0 1 0 12 5a3 3 0 1 0-5.598 1.5"></path><path d="M17.997 5.125a4 4 0 0 1 2.526 5.77"></path><path d="M18 18a4 4 0 0 0 2-7.464"></path><path d="M19.967 17.483A4 4 0 1 1 12 18a4 4 0 1 1-7.967-.517"></path><path d="M6 18a4 4 0 0 1-2-7.464"></path><path d="M6.003 5.125a4 4 0 0 0-2.526 5.77"></path>',
            'settings': '<path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32 1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"></path><circle cx="12" cy="12" r="3"></circle>',
            'container': '<path d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z"></path><path d="M10 21.9V14L2.1 9.1"></path><path d="m10 14 11.9-6.9"></path><path d="M14 19.8v-8.1"></path><path d="M18 17.5V9.4"></path>',
            'cloud': '<path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"></path>',
            'box': '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path>',
            'database': '<ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M3 5V19A9 3 0 0 0 21 19V5"></path><path d="M3 12A9 3 0 0 0 21 12"></path>',
            'leaf': '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>',
            'coffee': '<path d="M10 2v2"></path><path d="M14 2v2"></path><path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"></path><path d="M6 2v2"></path>',
            'code-xml': '<path d="m18 16 4-4-4-4"></path><path d="m6 8-4 4 4 4"></path><path d="m14.5 4-5 16"></path>',
            'pen-tool': '<path d="M15.707 21.293a1 1 0 0 1-1.414 0l-1.586-1.586a1 1 0 0 1 0-1.414l5.586-5.586a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 1 0 1.414z"></path><path d="m18 13-1.375-6.874a1 1 0 0 0-.746-.776L3.235 2.028a1 1 0 0 0-1.207 1.207L5.35 15.879a1 1 0 0 0 .776.746L13 18"></path><path d="m2.3 2.3 7.286 7.286"></path><circle cx="11" cy="11" r="2"></circle>',
            'server': '<rect width="20" height="8" x="2" y="2" rx="2" ry="2"></rect><rect width="20" height="8" x="2" y="14" rx="2" ry="2"></rect><line x1="6" x2="6.01" y1="6" y2="6"></line><line x1="6" x2="6.01" y1="18" y2="18"></line>',
            'code': '<path d="m18 16 4-4-4-4"></path><path d="m6 8-4 4 4 4"></path>'
        };

        return `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 mx-auto transition-colors duration-300 text-[#0056bc] group-hover:text-[#de244b]" aria-hidden="true">${icons[iconName] || icons['code']}</svg>`;
    }

    animateCards() {
        if (!this.isVisible) return;

        const cards = document.querySelectorAll('.tech-card');
        cards.forEach((card, index) => {
            card.classList.remove('opacity-0');
            card.classList.add('animate-fade-scale');
        });
    }

    createFloatingParticles() {
        const container = document.getElementById('floating-particles');
        if (!container) return;

        const particles = [
            { top: '2.5rem', left: '2.5rem', size: '0.75rem', delay: '0s' },
            { top: '8rem', right: '5rem', size: '0.5rem', delay: '1s' },
            { bottom: '5rem', left: '25%', size: '1rem', delay: '2s' },
            { top: '50%', right: '33.333333%', size: '0.75rem', delay: '3s' }
        ];

        particles.forEach(particle => {
            const div = document.createElement('div');
            div.className = 'animate-float absolute bg-[#0056bc] rounded-full';
            div.style.cssText = `
                top: ${particle.top || 'auto'};
                left: ${particle.left || 'auto'};
                right: ${particle.right || 'auto'};
                bottom: ${particle.bottom || 'auto'};
                width: ${particle.size};
                height: ${particle.size};
                animation-delay: ${particle.delay};
            `;
            container.appendChild(div);
        });
    }
}

// Export for Laravel
window.BadgeSlider = BadgeSlider;
</script>
@endpush