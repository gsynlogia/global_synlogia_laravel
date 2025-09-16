{{-- Header nawigacyjny --}}
<header class="bg-white/95 backdrop-blur-md border-b border-gray-200 m-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-16 justify-between md:justify-start">
            <!-- Logo -->
            <div class="flex-shrink-0 md:mr-8">
                <a class="flex items-center cursor-pointer" href="#">
                    <img alt="Global Synlogia" title="Global Synlogia"
                         class="w-auto"
                         style="height:121px;position:relative;z-index:10"
                         src="{{ asset('logo-color.png') }}"/>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex flex-1">
                <div class="flex-1 flex items-center justify-evenly">
                    <a class="cursor-pointer font-bold uppercase text-[#de244b] active-nav-item px-3 py-2 text-sm font-bold"
                       style="animation-delay:0s" href="#">Strona główna</a>
                    <a class="cursor-pointer text-gray-800 uppercase hover:text-[#de244b] hover-nav-item px-3 py-2 text-sm font-bold"
                       style="animation-delay:0.1s" href="#">Usługi</a>
                    <a class="cursor-pointer text-gray-800 uppercase hover:text-[#de244b] hover-nav-item px-3 py-2 text-sm font-bold"
                       style="animation-delay:0.2s" href="#">Blog</a>
                    <a class="cursor-pointer text-gray-800 uppercase hover:text-[#de244b] hover-nav-item px-3 py-2 text-sm font-bold"
                       style="animation-delay:0.3s" href="#">Szkolenia</a>
                    <a class="cursor-pointer text-gray-800 uppercase hover:text-[#de244b] hover-nav-item px-3 py-2 text-sm font-bold"
                       style="animation-delay:0.4s" href="#">O firmie</a>
                    <a class="cursor-pointer text-gray-800 uppercase hover:text-[#de244b] hover-nav-item px-3 py-2 text-sm font-bold"
                       style="animation-delay:0.5s" href="#">Kontakt</a>
                </div>
            </nav>

            <!-- Mobile menu button -->
            <div class="md:hidden flex-shrink-0">
                <button class="text-gray-800 hover:text-[#0056bc] hover:bg-blue-50 inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0056bc] cursor-pointer transition-all duration-300"
                        aria-expanded="false">
                    <span class="sr-only">Otwórz menu główne</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

@push('style_navigation_header')
<style>
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
</style>
@endpush