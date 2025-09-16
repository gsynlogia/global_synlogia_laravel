{{-- Niebieski pasek informacyjny --}}
<div class="sticky top-0 z-50">
    <div class="text-white py-3 px-4 w-full" style="background-color: #0056bc;">
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
</div>

@push('style_blue_info_banner_top')
<style>
    /* Info banner specific styles */
    .info-banner {
        background-color: #0056bc;
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
</style>
@endpush