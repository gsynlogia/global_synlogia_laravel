class TechSection {
    constructor() {
        this.isVisible = false;
        this.technologies = [
            {
                name: "Python",
                icon: "code2",
                description: "Backend development, AI/ML, Data Science",
                color: "bg-green-600",
                link: "/technologie/python"
            },
            {
                name: "React",
                icon: "atom",
                description: "Modern frontend applications",
                color: "bg-[#0056bc]",
                link: "/technologie/react"
            },
            {
                name: "Node.js",
                icon: "terminal",
                description: "Server-side JavaScript runtime",
                color: "bg-green-700",
                link: "/technologie/nodejs"
            },
            {
                name: "FastAPI",
                icon: "zap",
                description: "High-performance Python web framework",
                color: "bg-teal-600",
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
                        ${LucideIcons.getIcon(tech.icon, "w-16 h-16 text-gray-700 group-hover:text-[#0056bc] transition-colors duration-300")}
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-[#0056bc] transition-colors duration-300">
                        ${tech.name}
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        ${tech.description}
                    </p>
                    <div class="h-2 ${tech.color} rounded-full opacity-20 group-hover:opacity-100 transition-opacity duration-500 mb-4"></div>
                    <div class="text-[#0056bc] font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
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