{{-- Tech Section Container --}}
<section id="tech-section" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-scale">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#124f9e] mb-6">
                Technologie
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Specjalizujemy się w najnowszych i najbardziej efektywnych technologiach
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="tech-grid">
            <!-- Technologies will be inserted here by JavaScript -->
        </div>
    </div>
</section>

@push('script_tech_section')
<script>
class TechSection {
    constructor() {
        this.isVisible = false;
        this.technologies = [
            {
                name: "Python",
                icon: "code2",
                description: "Backend development, AI/ML, Data Science",
                color: "bg-[#124f9e]",
                link: "/technologie/python"
            },
            {
                name: "React",
                icon: "atom",
                description: "Modern frontend applications",
                color: "bg-[#de244b]",
                link: "/technologie/react"
            },
            {
                name: "Node.js",
                icon: "terminal",
                description: "Server-side JavaScript runtime",
                color: "bg-[#124f9e]",
                link: "/technologie/nodejs"
            },
            {
                name: "FastAPI",
                icon: "zap",
                description: "High-performance Python web framework",
                color: "bg-[#de244b]",
                link: "/technologie/fastapi"
            }
        ];
    }

    init() {
        this.createTechGrid();
        this.setupIntersectionObserver();
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    this.isVisible = true;
                    this.animateTechs();
                }
            },
            { threshold: 0.1 }
        );

        const element = document.getElementById('tech-section');
        if (element) observer.observe(element);
    }

    createTechGrid() {
        const container = document.getElementById('tech-grid');
        if (!container) return;

        let html = '';
        this.technologies.forEach((tech, index) => {
            html += `
                <a href="${tech.link}"
                   class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-500 text-center group cursor-pointer block tech-card opacity-0"
                   style="animation-delay: ${index * 0.1}s">
                    <div class="flex justify-center mb-4 group-hover:animate-bounce">
                        ${LucideIcons.getIcon(tech.icon, "w-16 h-16 text-gray-700 group-hover:text-[#124f9e] transition-colors duration-300")}
                    </div>
                    <h3 class="text-lg font-bold text-[#124f9e] mb-3 group-hover:text-[#de244b] transition-colors duration-300">
                        ${tech.name}
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        ${tech.description}
                    </p>
                    <div class="h-2 ${tech.color} rounded-full opacity-20 group-hover:opacity-100 transition-opacity duration-500 mb-4"></div>
                    <div class="text-[#de244b] font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Zobacz szczegóły →
                    </div>
                </a>
            `;
        });

        container.innerHTML = html;
    }

    animateTechs() {
        if (!this.isVisible) return;

        const cards = document.querySelectorAll('.tech-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.remove('opacity-0');
                card.classList.add('animate-slide-up');
            }, index * 100);
        });
    }
}

// Export for Laravel
window.TechSection = TechSection;
</script>
@endpush