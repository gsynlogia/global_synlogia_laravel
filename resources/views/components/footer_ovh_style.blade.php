{{-- OVH/Home.pl Style Footer --}}
<footer class="bg-gray-900 text-white">
    {{-- Main Footer Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Top Section with Large Logo --}}
        <div class="mb-12 pb-8 border-b border-gray-700">
            <div class="flex flex-col md:flex-row justify-between items-start">
                {{-- Large Logo Section --}}
                <div class="mb-8 md:mb-0 md:mr-12">
                    <img
                        src="{{ asset('logo-color.png') }}"
                        alt="Global Synlogia"
                        class="h-16 md:h-20 lg:h-24 w-auto filter brightness-0 invert mb-4"
                    />
                    <p class="text-gray-300 text-lg max-w-md leading-relaxed">
                        Profesjonalne usługi programistyczne i technologie IT dla firm każdej wielkości.
                    </p>
                </div>

                {{-- Contact Info Box --}}
                <div class="bg-gray-800 rounded-lg p-6 min-w-72">
                    <h3 class="text-lg font-semibold mb-4 text-[#DE234B]">Skontaktuj się z nami</h3>
                    <div class="space-y-3">
                        <a href="mailto:kontakt@globalsynlogia.com" class="flex items-center text-gray-300 hover:text-white transition-colors">
                            <svg class="w-5 h-5 mr-3 text-[#DE234B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            kontakt@globalsynlogia.com
                        </a>
                        <a href="tel:+48663583950" class="flex items-center text-gray-300 hover:text-white transition-colors">
                            <svg class="w-5 h-5 mr-3 text-[#DE234B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            +48 663 583 950
                        </a>
                        <div class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-[#DE234B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Polska, obsługa zdalna
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Links Grid - 6 columns like OVH --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 mb-12">
            {{-- Usługi Webowe --}}
            <div>
                <h3 class="text-white font-semibold mb-4 border-b border-[#DE234B] pb-2">Usługi Webowe</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/uslugi/aplikacje-webowe" class="text-gray-300 hover:text-[#DE234B] transition-colors">Aplikacje React/Next.js</a></li>
                    <li><a href="/uslugi/laravel" class="text-gray-300 hover:text-[#DE234B] transition-colors">Systemy Laravel</a></li>
                    <li><a href="/uslugi/wordpress" class="text-gray-300 hover:text-[#DE234B] transition-colors">Strony WordPress</a></li>
                    <li><a href="/uslugi/ecommerce" class="text-gray-300 hover:text-[#DE234B] transition-colors">Sklepy internetowe</a></li>
                    <li><a href="/uslugi/api" class="text-gray-300 hover:text-[#DE234B] transition-colors">Integracje API</a></li>
                    <li><a href="/uslugi/seo" class="text-gray-300 hover:text-[#DE234B] transition-colors">Optymalizacja SEO</a></li>
                </ul>
            </div>

            {{-- Aplikacje Mobilne --}}
            <div>
                <h3 class="text-white font-semibold mb-4 border-b border-[#DE234B] pb-2">Aplikacje Mobilne</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/uslugi/react-native" class="text-gray-300 hover:text-[#DE234B] transition-colors">React Native</a></li>
                    <li><a href="/uslugi/flutter" class="text-gray-300 hover:text-[#DE234B] transition-colors">Flutter</a></li>
                    <li><a href="/uslugi/ios" class="text-gray-300 hover:text-[#DE234B] transition-colors">Aplikacje iOS</a></li>
                    <li><a href="/uslugi/android" class="text-gray-300 hover:text-[#DE234B] transition-colors">Aplikacje Android</a></li>
                    <li><a href="/uslugi/pwa" class="text-gray-300 hover:text-[#DE234B] transition-colors">Progressive Web Apps</a></li>
                    <li><a href="/uslugi/app-store" class="text-gray-300 hover:text-[#DE234B] transition-colors">Publikacja w sklepach</a></li>
                </ul>
            </div>

            {{-- Hosting & Infrastruktura --}}
            <div>
                <h3 class="text-white font-semibold mb-4 border-b border-[#DE234B] pb-2">Hosting & Infrastruktura</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/uslugi/aws" class="text-gray-300 hover:text-[#DE234B] transition-colors">Amazon AWS</a></li>
                    <li><a href="/uslugi/azure" class="text-gray-300 hover:text-[#DE234B] transition-colors">Microsoft Azure</a></li>
                    <li><a href="/uslugi/google-cloud" class="text-gray-300 hover:text-[#DE234B] transition-colors">Google Cloud</a></li>
                    <li><a href="/uslugi/vps" class="text-gray-300 hover:text-[#DE234B] transition-colors">Serwery VPS</a></li>
                    <li><a href="/uslugi/cdn" class="text-gray-300 hover:text-[#DE234B] transition-colors">CDN & Cache</a></li>
                    <li><a href="/uslugi/monitoring" class="text-gray-300 hover:text-[#DE234B] transition-colors">Monitoring 24/7</a></li>
                </ul>
            </div>

            {{-- DevOps & Automatyzacja --}}
            <div>
                <h3 class="text-white font-semibold mb-4 border-b border-[#DE234B] pb-2">DevOps & CI/CD</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/uslugi/docker" class="text-gray-300 hover:text-[#DE234B] transition-colors">Docker & Kubernetes</a></li>
                    <li><a href="/uslugi/github-actions" class="text-gray-300 hover:text-[#DE234B] transition-colors">GitHub Actions</a></li>
                    <li><a href="/uslugi/jenkins" class="text-gray-300 hover:text-[#DE234B] transition-colors">Jenkins & CI/CD</a></li>
                    <li><a href="/uslugi/terraform" class="text-gray-300 hover:text-[#DE234B] transition-colors">Infrastructure as Code</a></li>
                    <li><a href="/uslugi/backup" class="text-gray-300 hover:text-[#DE234B] transition-colors">Backup & Recovery</a></li>
                    <li><a href="/uslugi/security" class="text-gray-300 hover:text-[#DE234B] transition-colors">Security Audits</a></li>
                </ul>
            </div>

            {{-- AI & Machine Learning --}}
            <div>
                <h3 class="text-white font-semibold mb-4 border-b border-[#DE234B] pb-2">AI & ML</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/uslugi/chatboty" class="text-gray-300 hover:text-[#DE234B] transition-colors">Chatboty AI</a></li>
                    <li><a href="/uslugi/nlp" class="text-gray-300 hover:text-[#DE234B] transition-colors">Przetwarzanie języka</a></li>
                    <li><a href="/uslugi/computer-vision" class="text-gray-300 hover:text-[#DE234B] transition-colors">Computer Vision</a></li>
                    <li><a href="/uslugi/data-analysis" class="text-gray-300 hover:text-[#DE234B] transition-colors">Analiza danych</a></li>
                    <li><a href="/uslugi/predictive" class="text-gray-300 hover:text-[#DE234B] transition-colors">Modele predykcyjne</a></li>
                    <li><a href="/uslugi/automation" class="text-gray-300 hover:text-[#DE234B] transition-colors">Automatyzacja procesów</a></li>
                </ul>
            </div>

            {{-- Wsparcie & Konsulting --}}
            <div>
                <h3 class="text-white font-semibold mb-4 border-b border-[#DE234B] pb-2">Wsparcie & Konsulting</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/uslugi/audyt" class="text-gray-300 hover:text-[#DE234B] transition-colors">Audyt techniczny</a></li>
                    <li><a href="/uslugi/migracja" class="text-gray-300 hover:text-[#DE234B] transition-colors">Migracja systemów</a></li>
                    <li><a href="/uslugi/optymalizacja" class="text-gray-300 hover:text-[#DE234B] transition-colors">Optymalizacja wydajności</a></li>
                    <li><a href="/uslugi/szkolenia" class="text-gray-300 hover:text-[#DE234B] transition-colors">Szkolenia zespołów</a></li>
                    <li><a href="/uslugi/wsparcie-24-7" class="text-gray-300 hover:text-[#DE234B] transition-colors">Wsparcie 24/7</a></li>
                    <li><a href="/uslugi/maintenance" class="text-gray-300 hover:text-[#DE234B] transition-colors">Maintenance & Updates</a></li>
                </ul>
            </div>
        </div>

        {{-- Social Media & Additional Links --}}
        <div class="flex flex-col md:flex-row justify-between items-center py-8 border-t border-gray-700">
            {{-- Social Media --}}
            <div class="mb-6 md:mb-0">
                <h4 class="text-white font-semibold mb-3">Śledź nas</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-[#DE234B] transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#DE234B] transition-colors">
                        <span class="sr-only">LinkedIn</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#DE234B] transition-colors">
                        <span class="sr-only">GitHub</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#DE234B] transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Additional Links --}}
            <div class="text-center md:text-right">
                <div class="flex flex-wrap justify-center md:justify-end space-x-6 mb-3">
                    <a href="/o-firmie" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors">O firmie</a>
                    <a href="/portfolio" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors">Portfolio</a>
                    <a href="/kariera" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors">Kariera</a>
                    <a href="/blog" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors">Blog</a>
                </div>
                <div class="flex flex-wrap justify-center md:justify-end space-x-6">
                    <a href="/polityka-cookies" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors">Polityka cookies</a>
                    <a href="/polityka-prywatnosci" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors">Polityka prywatności</a>
                    <a href="/regulamin" class="text-gray-400 hover:text-[#DE234B] text-sm transition-colors">Regulamin</a>
                </div>
            </div>
        </div>

        {{-- Bottom Copyright --}}
        <div class="border-t border-gray-700 pt-6 text-center">
            <p class="text-gray-400 text-sm" id="footer-copyright">
                &copy; <span id="current-year"></span> Global Synlogia. Wszystkie prawa zastrzeżone.
            </p>
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