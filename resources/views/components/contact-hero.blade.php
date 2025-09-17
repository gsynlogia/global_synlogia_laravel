{{-- Contact Hero Section --}}
<section class="contact-hero relative py-16 bg-gray-50 overflow-hidden">
    {{-- Background Decorations --}}
    <div class="absolute inset-0 opacity-10">
        <div class="animate-float absolute top-20 left-20 w-16 h-16 bg-[#124f9e] rounded-full"></div>
        <div class="animate-float absolute bottom-20 right-20 w-20 h-20 bg-[#de244b] rounded-full" style="animation-delay:1s"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
        <h1 class="hero-title text-2xl md:text-3xl lg:text-4xl font-bold text-[#124f9e] mb-6 leading-tight">
            Skontaktuj się z<span class="text-[#de244b]"> Nami</span>
        </h1>
        <p class="hero-subtitle text-xl text-gray-600 mb-8 leading-relaxed max-w-3xl mx-auto">
            Gotowy na realizację swojego projektu IT? Napisz do nas, zadzwoń lub odwiedź nasze biuro w Gdańsku.
        </p>
    </div>
</section>

@push('style_contact_hero')
<style>
.animate-float {
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

.hero-title {
    animation: fadeSlideUp 1s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

.hero-subtitle {
    animation: fadeSlideUp 1s ease-out 0.2s forwards;
    opacity: 0;
    transform: translateY(30px);
}

@keyframes fadeSlideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@push('script_contact_hero')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for contact form button
    const contactButton = document.querySelector('a[href="#contact-form"]');
    if (contactButton) {
        contactButton.addEventListener('click', function(e) {
            e.preventDefault();
            const contactForm = document.getElementById('contact-form');
            if (contactForm) {
                contactForm.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    // Add animation to floating particles
    const particles = document.querySelectorAll('.floating-particle');
    particles.forEach((particle, index) => {
        particle.style.animationDelay = `${index * 0.5}s`;
    });
});
</script>
@endpush