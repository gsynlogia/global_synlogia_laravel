{{-- FAQ Section --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="faq-title text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Często Zadawane Pytania
            </h2>
            <p class="faq-subtitle text-lg text-gray-600">
                Odpowiedzi na najczęstsze pytania dotyczące naszych usług
            </p>
        </div>

        <div class="space-y-6">
            <div class="faq-item bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Jak długo trwa realizacja projektu?
                </h3>
                <p class="text-gray-600">
                    Czas realizacji zależy od złożoności projektu. Proste strony internetowe - 2-4 tygodnie,
                    aplikacje mobilne - 2-4 miesiące, systemy enterprise - 3-12 miesięcy.
                </p>
            </div>

            <div class="faq-item bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Czy oferujecie wsparcie po zakończeniu projektu?
                </h3>
                <p class="text-gray-600">
                    Tak, każdy projekt obejmuje gwarancję i wsparcie techniczne. Oferujemy również
                    długoterminowe umowy serwisowe i rozwój aplikacji.
                </p>
            </div>

            <div class="faq-item bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Jakie technologie wykorzystujecie?
                </h3>
                <p class="text-gray-600">
                    Specjalizujemy się w nowoczesnych technologiach: React, Next.js, Node.js, Python,
                    React Native, AWS, Azure oraz wielu innych zgodnie z potrzebami projektu.
                </p>
            </div>

            <div class="faq-item bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Czy pracujecie z firmami spoza Gdańska?
                </h3>
                <p class="text-gray-600">
                    Oczywiście! Współpracujemy z klientami z całej Polski i zagranicy.
                    Większość projektów realizujemy zdalnie z możliwością spotkań online.
                </p>
            </div>
        </div>
    </div>
</section>

@push('style_contact_faq')
<style>
.faq-title {
    animation: fadeSlideUp 0.8s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

.faq-subtitle {
    animation: fadeSlideUp 0.8s ease-out 0.2s forwards;
    opacity: 0;
    transform: translateY(30px);
}

.faq-item {
    animation: fadeSlideUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.faq-item:nth-child(1) { animation-delay: 0.1s; }
.faq-item:nth-child(2) { animation-delay: 0.2s; }
.faq-item:nth-child(3) { animation-delay: 0.3s; }
.faq-item:nth-child(4) { animation-delay: 0.4s; }

.faq-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    background-color: #f8fafc;
}

@keyframes fadeSlideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .faq-item {
        padding: 1.5rem;
    }

    .faq-title {
        font-size: 2rem;
    }
}
</style>
@endpush

@push('script_contact_faq')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scroll animation to FAQ items when they come into view
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observe all FAQ items
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        observer.observe(item);
    });

    // Add click interaction for better UX
    faqItems.forEach(item => {
        item.addEventListener('click', function() {
            // Add a subtle click effect
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
});
</script>
@endpush