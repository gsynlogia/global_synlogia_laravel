{{-- Contact Info Component --}}
<div class="contact-info-container">
    <div class="space-y-8">
        {{-- Contact Details Card --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
            <h3 class="text-2xl font-bold text-[#003366] mb-6 flex items-center">
                <div class="w-8 h-8 bg-gradient-to-r from-[#0056bc] to-[#DE234B] rounded-full mr-3"></div>
                Dane kontaktowe
            </h3>

            <div class="space-y-6">
                {{-- Address --}}
                <div class="contact-item flex items-start group cursor-pointer hover:bg-gray-50 p-4 rounded-xl transition-all duration-300">
                    <div class="contact-icon bg-[#DE234B] text-white rounded-full p-3 mr-4 flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#003366] mb-1 group-hover:text-[#0056bc] transition-colors duration-300">Adres</h4>
                        <p class="text-gray-600 leading-relaxed">
                            ul. Władysława Jagiełły 2/20<br>
                            80-180 Gdańsk<br>
                            Polska
                        </p>
                    </div>
                </div>

                {{-- Phone --}}
                <div class="contact-item flex items-start group cursor-pointer hover:bg-gray-50 p-4 rounded-xl transition-all duration-300">
                    <div class="contact-icon bg-[#0056bc] text-white rounded-full p-3 mr-4 flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#003366] mb-1 group-hover:text-[#0056bc] transition-colors duration-300">Telefon</h4>
                        <a href="tel:+48123456789" class="text-[#0056bc] hover:text-[#DE234B] font-medium transition-colors duration-300">
                            +48 123 456 789
                        </a>
                        <p class="text-sm text-gray-500 mt-1">Poniedziałek - Piątek: 8:00 - 18:00</p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="contact-item flex items-start group cursor-pointer hover:bg-gray-50 p-4 rounded-xl transition-all duration-300">
                    <div class="contact-icon bg-[#10B981] text-white rounded-full p-3 mr-4 flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#003366] mb-1 group-hover:text-[#0056bc] transition-colors duration-300">Email</h4>
                        <a href="mailto:kontakt@globalsynlogia.com" class="text-[#0056bc] hover:text-[#DE234B] font-medium transition-colors duration-300">
                            kontakt@globalsynlogia.com
                        </a>
                        <p class="text-sm text-gray-500 mt-1">Odpowiadamy w ciągu 24 godzin</p>
                    </div>
                </div>

                {{-- Business Hours --}}
                <div class="contact-item flex items-start group cursor-pointer hover:bg-gray-50 p-4 rounded-xl transition-all duration-300">
                    <div class="contact-icon bg-[#F59E0B] text-white rounded-full p-3 mr-4 flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#003366] mb-1 group-hover:text-[#0056bc] transition-colors duration-300">Godziny pracy</h4>
                        <div class="text-gray-600 space-y-1">
                            <p><span class="font-medium">Pon - Pt:</span> 8:00 - 18:00</p>
                            <p><span class="font-medium">Sobota:</span> 9:00 - 14:00</p>
                            <p><span class="font-medium">Niedziela:</span> Zamknięte</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Social Media & Quick Actions --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
            <h3 class="text-2xl font-bold text-[#003366] mb-6 flex items-center">
                <div class="w-8 h-8 bg-gradient-to-r from-[#DE234B] to-[#0056bc] rounded-full mr-3"></div>
                Śledź nas
            </h3>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <a href="#" class="social-link flex items-center p-4 bg-[#1877F2] text-white rounded-xl hover:bg-[#166fe5] transition-all duration-300 transform hover:scale-105">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </a>

                <a href="#" class="social-link flex items-center p-4 bg-[#0077B5] text-white rounded-xl hover:bg-[#006396] transition-all duration-300 transform hover:scale-105">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                    LinkedIn
                </a>
            </div>

            <div class="space-y-4">
                <a href="tel:+48123456789" class="quick-action flex items-center justify-center p-4 bg-gradient-to-r from-[#10B981] to-[#059669] text-white rounded-xl hover:from-[#059669] hover:to-[#047857] transition-all duration-300 transform hover:scale-105 font-bold">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                    </svg>
                    Zadzwoń teraz
                </a>

                <a href="mailto:kontakt@globalsynlogia.com" class="quick-action flex items-center justify-center p-4 bg-gradient-to-r from-[#0056bc] to-[#003366] text-white rounded-xl hover:from-[#DE234B] hover:to-[#c41e3f] transition-all duration-300 transform hover:scale-105 font-bold">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    Napisz email
                </a>
            </div>
        </div>

        {{-- FAQ Section --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
            <h3 class="text-2xl font-bold text-[#003366] mb-6 flex items-center">
                <div class="w-8 h-8 bg-gradient-to-r from-[#F59E0B] to-[#DE234B] rounded-full mr-3"></div>
                Najczęściej zadawane pytania
            </h3>

            <div class="space-y-4">
                <div class="faq-item border border-gray-200 rounded-xl">
                    <button class="faq-question w-full text-left p-4 hover:bg-gray-50 transition-colors duration-300 flex items-center justify-between" data-faq="1">
                        <span class="font-bold text-[#003366]">Ile czasu trwa realizacja projektu?</span>
                        <svg class="faq-chevron w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="faq-answer hidden p-4 pt-0 text-gray-600">
                        Czas realizacji zależy od złożoności projektu. Proste strony internetowe realizujemy w 2-4 tygodnie, aplikacje mobilne w 6-12 tygodni, a rozbudowane systemy w 3-6 miesięcy.
                    </div>
                </div>

                <div class="faq-item border border-gray-200 rounded-xl">
                    <button class="faq-question w-full text-left p-4 hover:bg-gray-50 transition-colors duration-300 flex items-center justify-between" data-faq="2">
                        <span class="font-bold text-[#003366]">Czy oferujecie wsparcie po zakończeniu projektu?</span>
                        <svg class="faq-chevron w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="faq-answer hidden p-4 pt-0 text-gray-600">
                        Tak, oferujemy różne pakiety wsparcia technicznego. Podstawowe wsparcie przez 3 miesiące jest zawsze włączone w cenę projektu. Dostępne są również rozszerzone pakiety wsparcia.
                    </div>
                </div>

                <div class="faq-item border border-gray-200 rounded-xl">
                    <button class="faq-question w-full text-left p-4 hover:bg-gray-50 transition-colors duration-300 flex items-center justify-between" data-faq="3">
                        <span class="font-bold text-[#003366]">Jakie technologie używacie?</span>
                        <svg class="faq-chevron w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="faq-answer hidden p-4 pt-0 text-gray-600">
                        Używamy najnowszych technologii: React, Next.js, Vue.js, Laravel, Node.js, Python, React Native, Flutter oraz rozwiązania chmurowe AWS i Azure. Dobieramy technologie do specyfiki projektu.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('style_contact_info')
<style>
.contact-info-container {
    animation: fadeSlideIn 0.8s ease-out 0.3s forwards;
    opacity: 0;
    transform: translateY(30px);
}

.contact-item {
    position: relative;
    overflow: hidden;
}

.contact-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 86, 188, 0.05), transparent);
    transition: left 0.5s;
}

.contact-item:hover::before {
    left: 100%;
}

.contact-icon {
    position: relative;
    transition: all 0.3s ease;
}

.contact-icon::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;
}

.contact-item:hover .contact-icon::after {
    width: 100%;
    height: 100%;
}

.social-link {
    position: relative;
    overflow: hidden;
}

.social-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.social-link:hover::before {
    left: 100%;
}

.quick-action {
    position: relative;
    overflow: hidden;
}

.quick-action::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.quick-action:hover::before {
    left: 100%;
}

.faq-chevron.rotate {
    transform: rotate(180deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.faq-answer.show {
    max-height: 200px;
}

@keyframes fadeSlideIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .contact-info-container {
        margin-top: 2rem;
    }

    .social-link {
        justify-content: center;
        font-size: 0.875rem;
    }

    .quick-action {
        font-size: 0.875rem;
    }
}
</style>
@endpush

@push('script_contact_info')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Toggle functionality
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const chevron = this.querySelector('.faq-chevron');
            const allAnswers = document.querySelectorAll('.faq-answer');
            const allChevrons = document.querySelectorAll('.faq-chevron');

            // Close all other answers
            allAnswers.forEach((otherAnswer, index) => {
                if (otherAnswer !== answer) {
                    otherAnswer.classList.remove('show');
                    allChevrons[index].classList.remove('rotate');
                }
            });

            // Toggle current answer
            answer.classList.toggle('show');
            chevron.classList.toggle('rotate');
        });
    });

    // Add click animations to contact items
    const contactItems = document.querySelectorAll('.contact-item');
    contactItems.forEach(item => {
        item.addEventListener('click', function() {
            // Add ripple effect
            const ripple = document.createElement('div');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (event.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (event.clientY - rect.top - size / 2) + 'px';
            ripple.classList.add('ripple');

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Smooth animations on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = '0.5s';
                entry.target.classList.add('animate-fade-in');
            }
        });
    });

    observer.observe(document.querySelector('.contact-info-container'));
});
</script>

<style>
.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(0, 86, 188, 0.1);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
</style>
@endpush