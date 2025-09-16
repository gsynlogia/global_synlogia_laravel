{{-- Professional Footer Container --}}
<footer class="bg-slate-900 text-white relative overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="h-full w-full" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.1\"><circle cx=\"30\" cy=\"30\" r=\"2\"/></g></g></svg>');"></div>
    </div>

    {{-- Main Footer Content --}}
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        {{-- Top Section with Logo and CTA --}}
        <div class="text-center mb-16">
            <div class="flex flex-col items-center space-y-6">
                <img
                    src="{{ asset('logo-color.png') }}"
                    alt="Global Synlogia"
                    class="h-20 w-auto filter brightness-0 invert"
                />
                <div class="h-1 w-16 bg-gradient-to-r from-[#DE234B] to-red-600 rounded-full"></div>
                <p class="text-xl text-gray-300 max-w-2xl leading-relaxed">
                    Profesjonalne usługi programistyczne i technologie IT.
                    Tworzymy nowoczesne rozwiązania dla Twojego biznesu.
                </p>
                <a href="#contact" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-[#DE234B] to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-[#DE234B] transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <span>Rozpocznij projekt</span>
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Links Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            {{-- Services --}}
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold mb-6 text-white flex items-center justify-center md:justify-start">
                    <span class="w-2 h-2 bg-[#DE234B] rounded-full mr-3"></span>
                    Usługi
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#services" class="text-gray-300 hover:text-[#DE234B] transition-colors duration-300 flex items-center justify-center md:justify-start group">
                            <span class="w-1 h-1 bg-gray-400 rounded-full mr-3 group-hover:bg-[#DE234B] transition-colors duration-300"></span>
                            Aplikacje Webowe
                        </a>
                    </li>
                    <li>
                        <a href="#services" class="text-gray-300 hover:text-[#DE234B] transition-colors duration-300 flex items-center justify-center md:justify-start group">
                            <span class="w-1 h-1 bg-gray-400 rounded-full mr-3 group-hover:bg-[#DE234B] transition-colors duration-300"></span>
                            Hosting & Infrastruktura
                        </a>
                    </li>
                    <li>
                        <a href="#services" class="text-gray-300 hover:text-[#DE234B] transition-colors duration-300 flex items-center justify-center md:justify-start group">
                            <span class="w-1 h-1 bg-gray-400 rounded-full mr-3 group-hover:bg-[#DE234B] transition-colors duration-300"></span>
                            Aplikacje Mobilne
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold mb-6 text-white flex items-center justify-center md:justify-start">
                    <span class="w-2 h-2 bg-[#DE234B] rounded-full mr-3"></span>
                    Kontakt
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="mailto:kontakt@globalsynlogia.com" class="text-gray-300 hover:text-[#DE234B] transition-colors duration-300 flex items-center justify-center md:justify-start group">
                            <svg class="w-4 h-4 mr-3 group-hover:text-[#DE234B] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            kontakt@globalsynlogia.com
                        </a>
                    </li>
                    <li>
                        <a href="tel:+48663583950" class="text-gray-300 hover:text-[#DE234B] transition-colors duration-300 flex items-center justify-center md:justify-start group">
                            <svg class="w-4 h-4 mr-3 group-hover:text-[#DE234B] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            +48 663 583 950
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="text-gray-300 hover:text-[#DE234B] transition-colors duration-300 flex items-center justify-center md:justify-start group">
                            <svg class="w-4 h-4 mr-3 group-hover:text-[#DE234B] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Więcej informacji →
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Social Media --}}
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold mb-6 text-white flex items-center justify-center md:justify-start">
                    <span class="w-2 h-2 bg-[#DE234B] rounded-full mr-3"></span>
                    Śledź nas
                </h3>
                <div class="flex space-x-4 justify-center md:justify-start">
                    <a href="#" class="bg-gray-800 p-3 rounded-lg text-gray-300 hover:text-white hover:bg-[#DE234B] transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 p-3 rounded-lg text-gray-300 hover:text-white hover:bg-[#DE234B] transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg">
                        <span class="sr-only">LinkedIn</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 p-3 rounded-lg text-gray-300 hover:text-white hover:bg-[#DE234B] transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg">
                        <span class="sr-only">GitHub</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom Section --}}
        <div class="border-t border-gray-700 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-gray-400 text-sm flex items-center" id="footer-copyright">
                    <span class="w-1 h-1 bg-[#DE234B] rounded-full mr-2"></span>
                    &copy; <span id="current-year"></span> Global Synlogia. Wszystkie prawa zastrzeżone.
                </p>
                <div class="flex flex-wrap justify-center space-x-6">
                    <a href="/polityka-cookies" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors duration-300">
                        Polityka cookies
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors duration-300">
                        Polityka prywatności
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors duration-300">
                        Regulamin
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('script_footer')
<script>
class Footer {
    constructor() {
        this.currentYear = new Date().getFullYear();
    }

    init() {
        this.updateCopyright();
        this.attachSmoothScrollListeners();
    }

    updateCopyright() {
        const yearElement = document.getElementById('current-year');
        if (yearElement) {
            yearElement.textContent = this.currentYear;
        }
    }

    attachSmoothScrollListeners() {
        // Smooth scroll for anchor links within footer
        const anchorLinks = document.querySelectorAll('footer a[href^="#"]');

        anchorLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();

                const targetId = link.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
}

// Export for Laravel
window.Footer = Footer;
</script>
@endpush