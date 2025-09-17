{{-- Contact Info Cards Section --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            {{-- Address Card --}}
            <div class="contact-card text-center p-8 rounded-2xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <svg class="w-10 h-10 text-[#0056bc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10h.01M12 14h.01M12 6h.01M16 10h.01M16 14h.01M16 6h.01M8 10h.01M8 14h.01M8 6h.01M9 22v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"></path>
                        <rect x="4" y="2" width="16" height="20" rx="2"></rect>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Adres Firmy</h3>
                <div class="space-y-2">
                    <p class="text-gray-600">ul. Władysława Jagiełły 2/20</p>
                    <p class="text-gray-600">80-180 Gdańsk</p>
                    <p class="text-gray-600">Polska</p>
                </div>
            </div>

            {{-- Phone Card --}}
            <div class="contact-card text-center p-8 rounded-2xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <svg class="w-10 h-10 text-[#0056bc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Telefon</h3>
                <div class="space-y-2">
                    <p class="text-gray-600">
                        <a href="tel:+48663583950" class="hover:text-[#0056bc] transition-colors">+48 663 583 950</a>
                    </p>
                </div>
            </div>

            {{-- Email Card --}}
            <div class="contact-card text-center p-8 rounded-2xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <svg class="w-10 h-10 text-[#0056bc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                        <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Email</h3>
                <div class="space-y-2">
                    <p class="text-gray-600">
                        <a href="mailto:kontakt@globalsynlogia.com" class="hover:text-[#0056bc] transition-colors">kontakt@globalsynlogia.com</a>
                    </p>
                </div>
            </div>

            {{-- Business Hours Card --}}
            <div class="contact-card text-center p-8 rounded-2xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <svg class="w-10 h-10 text-[#0056bc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"></path>
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Godziny Pracy</h3>
                <div class="space-y-2">
                    <p class="text-gray-600">Poniedziałek - Piątek: 9:00 - 17:00</p>
                    <p class="text-gray-600">Sobota - Niedziela: Zamknięte</p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('style_contact_cards')
<style>
.contact-card {
    animation: fadeSlideUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
}

.contact-card:nth-child(1) { animation-delay: 0.1s; }
.contact-card:nth-child(2) { animation-delay: 0.2s; }
.contact-card:nth-child(3) { animation-delay: 0.3s; }
.contact-card:nth-child(4) { animation-delay: 0.4s; }

.contact-card:hover {
    transform: translateY(-5px);
}

@keyframes fadeSlideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .contact-card {
        padding: 1.5rem;
    }
}
</style>
@endpush

@push('script_contact_cards')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth hover animations
    const cards = document.querySelectorAll('.contact-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush