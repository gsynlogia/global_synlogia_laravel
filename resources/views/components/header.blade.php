{{-- Sticky Header Container (Info Banner + Navigation) --}}
<div class="sticky top-0 z-50">
    {{-- Niebieski pasek informacyjny --}}
    <div class="text-white py-3 px-4 w-full" style="background-color: #124f9e;">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-sm md:text-base font-medium text-center">
                    <span class="font-semibold">Strona w fazie rozwoju</span> - Obecnie przyjmujemy zamówienia selektywnie.
                    <span class="hidden sm:inline"> Realizacja usług wyłącznie po potwierdzeniu mailowym.</span>
                    <span class="sm:hidden"> Usługi po potwierdzeniu mailowym.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Header nawigacyjny --}}
    <header class="bg-white/95 backdrop-blur-md border-b border-gray-200 m-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-16 justify-between md:justify-start">
                <!-- Logo -->
                <div class="flex-shrink-0 md:mr-8">
                    <a class="flex items-center cursor-pointer" href="/">
                        <img alt="Global Synlogia" title="Global Synlogia"
                             class="w-auto"
                             style="height:121px;position:relative;z-index:10"
                             src="{{ asset('logo-color.png') }}"/>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex flex-1">
                    <div class="flex-1 flex items-center justify-evenly">
                        <a class="cursor-pointer uppercase px-3 py-2 text-sm font-bold {{ request()->is('/') ? 'text-[#de244b] active-nav-item' : 'text-gray-800 hover:text-[#de244b] hover-nav-item' }}"
                           style="animation-delay:0s" href="/">Strona główna</a>
                        <a class="cursor-pointer uppercase px-3 py-2 text-sm font-bold {{ request()->is('uslugi') ? 'text-[#de244b] active-nav-item' : 'text-gray-800 hover:text-[#de244b] hover-nav-item' }}"
                           style="animation-delay:0.1s" href="/uslugi">Usługi</a>
                        <a class="cursor-pointer uppercase px-3 py-2 text-sm font-bold {{ request()->is('blog') ? 'text-[#de244b] active-nav-item' : 'text-gray-800 hover:text-[#de244b] hover-nav-item' }}"
                           style="animation-delay:0.2s" href="/blog">Blog</a>
                        <a class="cursor-pointer text-gray-800 uppercase hover:text-[#de244b] hover-nav-item px-3 py-2 text-sm font-bold"
                           style="animation-delay:0.3s" href="#">Szkolenia</a>
                        <a class="cursor-pointer uppercase px-3 py-2 text-sm font-bold {{ request()->is('o-firmie') ? 'text-[#de244b] active-nav-item' : 'text-gray-800 hover:text-[#de244b] hover-nav-item' }}"
                           style="animation-delay:0.4s" href="/o-firmie">O firmie</a>
                        <a class="cursor-pointer uppercase px-3 py-2 text-sm font-bold {{ request()->is('kontakt') ? 'text-[#de244b] active-nav-item' : 'text-gray-800 hover:text-[#de244b] hover-nav-item' }}"
                           style="animation-delay:0.5s" href="/kontakt">Kontakt</a>
                    </div>
                </nav>

                <!-- Mobile menu button -->
                <div class="md:hidden flex-shrink-0">
                    <button id="mobile-menu-btn"
                            class="text-gray-800 hover:text-[#124f9e] hover:bg-blue-50 inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#124f9e] cursor-pointer transition-all duration-300"
                            aria-expanded="false">
                        <span class="sr-only">Otwórz menu główne</span>
                        <svg id="menu-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
                <a href="/" class="{{ request()->is('/') ? 'text-[#de244b]' : 'text-gray-800 hover:text-[#de244b]' }} block px-3 py-2 text-base font-medium">Strona główna</a>
                <a href="/uslugi" class="{{ request()->is('uslugi') ? 'text-[#de244b]' : 'text-gray-800 hover:text-[#de244b]' }} block px-3 py-2 text-base font-medium">Usługi</a>
                <a href="/blog" class="{{ request()->is('blog') ? 'text-[#de244b]' : 'text-gray-800 hover:text-[#de244b]' }} block px-3 py-2 text-base font-medium">Blog</a>
                <a href="#" class="text-gray-800 hover:text-[#de244b] block px-3 py-2 text-base font-medium">Szkolenia</a>
                <a href="/o-firmie" class="{{ request()->is('o-firmie') ? 'text-[#de244b]' : 'text-gray-800 hover:text-[#de244b]' }} block px-3 py-2 text-base font-medium">O firmie</a>
                <a href="/kontakt" class="{{ request()->is('kontakt') ? 'text-[#de244b]' : 'text-gray-800 hover:text-[#de244b]' }} block px-3 py-2 text-base font-medium">Kontakt</a>
            </div>
        </div>
    </header>
</div>

@push('style_header')
<style>
    /* Info banner specific styles */
    .info-banner {
        background-color: #124f9e;
    }

    .info-banner .info-icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }

    /* Navigation hover effects */
    .hover-nav-item {
        transition: color 0.3s ease;
        position: relative;
    }

    .hover-nav-item:hover {
        color: #de244b !important;
    }

    .hover-nav-item::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background-color: #de244b;
        transition: width 0.3s ease-out;
    }

    .hover-nav-item:hover::after {
        width: 100%;
    }

    .active-nav-item {
        color: #de244b !important;
        position: relative;
    }

    .active-nav-item::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background-color: #de244b;
        animation: expandFromCenter 0.3s ease-out forwards;
    }

    @keyframes expandFromCenter {
        from {
            width: 0;
        }
        to {
            width: 100%;
        }
    }

    /* Mobile menu button hover */
    .mobile-menu-btn {
        transition: all 0.3s ease;
    }

    /* Backdrop blur for header */
    .header-backdrop {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    /* Mobile menu animation */
    .animate-slide-up {
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@push('script_header')
<script>
class Header {
    constructor() {
        this.isMenuOpen = false;
        this.mobileMenuBtn = null;
        this.mobileMenu = null;
        this.menuIcon = null;
        this.closeIcon = null;
    }

    init() {
        this.mobileMenuBtn = document.getElementById('mobile-menu-btn');
        this.mobileMenu = document.getElementById('mobile-menu');
        this.menuIcon = document.getElementById('menu-icon');
        this.closeIcon = document.getElementById('close-icon');

        if (this.mobileMenuBtn) {
            this.attachEventListeners();
        }

        this.setupSmoothScroll();
    }

    attachEventListeners() {
        this.mobileMenuBtn.addEventListener('click', () => {
            this.toggleMobileMenu();
        });

        // Close mobile menu when clicking on a link
        const mobileLinks = this.mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                this.closeMobileMenu();
            });
        });
    }

    toggleMobileMenu() {
        this.isMenuOpen = !this.isMenuOpen;
        this.updateMobileMenuDisplay();
    }

    closeMobileMenu() {
        this.isMenuOpen = false;
        this.updateMobileMenuDisplay();
    }

    updateMobileMenuDisplay() {
        if (this.isMenuOpen) {
            this.mobileMenu.classList.remove('hidden');
            this.mobileMenu.classList.add('animate-slide-up');
            this.menuIcon.classList.add('hidden');
            this.closeIcon.classList.remove('hidden');
            this.mobileMenuBtn.setAttribute('aria-expanded', 'true');
        } else {
            this.mobileMenu.classList.add('hidden');
            this.mobileMenu.classList.remove('animate-slide-up');
            this.menuIcon.classList.remove('hidden');
            this.closeIcon.classList.add('hidden');
            this.mobileMenuBtn.setAttribute('aria-expanded', 'false');
        }
    }

    setupSmoothScroll() {
        // Smooth scroll for anchor links
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');

                // Skip if it's just "#"
                if (href === '#') return;

                e.preventDefault();

                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    // Close mobile menu if open
                    this.closeMobileMenu();

                    // Smooth scroll to target
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
window.Header = Header;
</script>
@endpush