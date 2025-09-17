{{-- Contact Form Component --}}
<div id="contact-form" class="contact-form-container">
    <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
        <div class="text-center mb-8">
            <h2 class="text-lg font-bold text-[#124f9e] mb-4">Wyślij wiadomość</h2>
            <p class="text-gray-600">Wypełnij formularz, a skontaktujemy się z Tobą w ciągu 24 godzin</p>
        </div>

        <form id="contactForm" class="space-y-6" novalidate>
            {{-- Form Status Message --}}
            <div id="formMessage" class="form-message hidden p-4 rounded-lg mb-6">
                <div class="flex items-center">
                    <div class="message-icon mr-3"></div>
                    <span class="message-text"></span>
                </div>
            </div>

            {{-- Name Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="firstName" class="block text-sm font-bold text-[#124f9e] mb-2">
                        Imię <span class="text-[#de244b]">*</span>
                    </label>
                    <input
                        type="text"
                        id="firstName"
                        name="firstName"
                        required
                        class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#124f9e] focus:outline-none transition-colors duration-300"
                        placeholder="Twoje imię"
                    >
                    <div class="error-message text-[#de244b] text-sm mt-1 hidden"></div>
                </div>

                <div class="form-group">
                    <label for="lastName" class="block text-sm font-bold text-[#124f9e] mb-2">
                        Nazwisko <span class="text-[#de244b]">*</span>
                    </label>
                    <input
                        type="text"
                        id="lastName"
                        name="lastName"
                        required
                        class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#124f9e] focus:outline-none transition-colors duration-300"
                        placeholder="Twoje nazwisko"
                    >
                    <div class="error-message text-[#de244b] text-sm mt-1 hidden"></div>
                </div>
            </div>

            {{-- Contact Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="email" class="block text-sm font-bold text-[#124f9e] mb-2">
                        Email <span class="text-[#de244b]">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#124f9e] focus:outline-none transition-colors duration-300"
                        placeholder="twoj@email.com"
                    >
                    <div class="error-message text-[#de244b] text-sm mt-1 hidden"></div>
                </div>

                <div class="form-group">
                    <label for="phone" class="block text-sm font-bold text-[#124f9e] mb-2">
                        Telefon
                    </label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#124f9e] focus:outline-none transition-colors duration-300"
                        placeholder="+48 123 456 789"
                    >
                    <div class="error-message text-[#de244b] text-sm mt-1 hidden"></div>
                </div>
            </div>

            {{-- Company and Subject --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="company" class="block text-sm font-bold text-[#124f9e] mb-2">
                        Firma
                    </label>
                    <input
                        type="text"
                        id="company"
                        name="company"
                        class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#124f9e] focus:outline-none transition-colors duration-300"
                        placeholder="Nazwa firmy"
                    >
                </div>

                <div class="form-group">
                    <label for="subject" class="block text-sm font-bold text-[#124f9e] mb-2">
                        Temat <span class="text-[#de244b]">*</span>
                    </label>
                    <select
                        id="subject"
                        name="subject"
                        required
                        class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#124f9e] focus:outline-none transition-colors duration-300"
                    >
                        <option value="">Wybierz temat</option>
                        <option value="web-development">Tworzenie stron internetowych</option>
                        <option value="mobile-apps">Aplikacje mobilne</option>
                        <option value="ai-solutions">Rozwiązania AI</option>
                        <option value="cloud-services">Usługi chmurowe</option>
                        <option value="blockchain">Blockchain</option>
                        <option value="consulting">Konsultacje IT</option>
                        <option value="other">Inne</option>
                    </select>
                    <div class="error-message text-[#de244b] text-sm mt-1 hidden"></div>
                </div>
            </div>

            {{-- Message --}}
            <div class="form-group">
                <label for="message" class="block text-sm font-bold text-[#124f9e] mb-2">
                    Wiadomość <span class="text-[#de244b]">*</span>
                </label>
                <textarea
                    id="message"
                    name="message"
                    rows="6"
                    required
                    class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0056bc] focus:outline-none transition-colors duration-300 resize-vertical"
                    placeholder="Opisz swój projekt lub zadaj pytanie..."
                ></textarea>
                <div class="error-message text-[#DE234B] text-sm mt-1 hidden"></div>
            </div>

            {{-- Privacy Policy --}}
            <div class="form-group">
                <label class="flex items-start cursor-pointer">
                    <input
                        type="checkbox"
                        id="privacy"
                        name="privacy"
                        required
                        class="form-checkbox mt-1 mr-3 w-5 h-5 text-[#124f9e] border-2 border-gray-300 rounded focus:ring-[#124f9e] focus:ring-2"
                    >
                    <span class="text-sm text-gray-600 leading-relaxed">
                        Wyrażam zgodę na przetwarzanie moich danych osobowych zgodnie z
                        <a href="/polityka-prywatnosci" class="text-[#de244b] hover:text-[#124f9e] underline">polityką prywatności</a>
                        <span class="text-[#de244b]">*</span>
                    </span>
                </label>
                <div class="error-message text-[#DE234B] text-sm mt-1 hidden"></div>
            </div>

            {{-- Submit Button --}}
            <div class="form-group">
                <button
                    type="submit"
                    id="submitBtn"
                    class="submit-button w-full bg-[#de244b] text-white font-bold py-4 px-8 rounded-xl hover:bg-red-700 transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-red-300"
                >
                    <span class="button-text">Wyślij wiadomość</span>
                    <span class="loading-spinner hidden">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Wysyłanie...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('style_contact_form')
<style>
.contact-form-container {
    animation: fadeSlideIn 0.8s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

.form-input:focus {
    box-shadow: 0 0 0 3px rgba(18, 79, 158, 0.1);
}

.form-input.error {
    border-color: #de244b;
    box-shadow: 0 0 0 3px rgba(222, 36, 75, 0.1);
}

.form-input.success {
    border-color: #10B981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.form-message {
    transition: all 0.3s ease;
}

.form-message.success {
    background-color: #D1FAE5;
    border: 1px solid #10B981;
    color: #047857;
}

.form-message.error {
    background-color: #FEE2E2;
    border: 1px solid #EF4444;
    color: #DC2626;
}

.submit-button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.submit-button:disabled:hover {
    background: #de244b !important;
}

@keyframes fadeSlideIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Form animations */
.form-group {
    transition: all 0.3s ease;
}

.form-group:hover {
    transform: translateY(-2px);
}

/* Loading animation */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.loading-pulse {
    animation: pulse 1.5s ease-in-out infinite;
}

/* Responsive */
@media (max-width: 768px) {
    .contact-form-container {
        margin-top: 2rem;
    }

    .bg-white {
        padding: 1.5rem;
    }
}
</style>
@endpush

@push('script_contact_form')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const buttonText = submitBtn.querySelector('.button-text');
    const loadingSpinner = submitBtn.querySelector('.loading-spinner');
    const formMessage = document.getElementById('formMessage');

    // Form validation
    const validators = {
        firstName: (value) => value.trim().length >= 2,
        lastName: (value) => value.trim().length >= 2,
        email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
        phone: (value) => !value || /^[\+]?[0-9\s\-\(\)]{9,}$/.test(value),
        subject: (value) => value.trim() !== '',
        message: (value) => value.trim().length >= 10,
        privacy: (value) => value === true
    };

    const errorMessages = {
        firstName: 'Imię musi zawierać co najmniej 2 znaki',
        lastName: 'Nazwisko musi zawierać co najmniej 2 znaki',
        email: 'Wprowadź poprawny adres email',
        phone: 'Wprowadź poprawny numer telefonu',
        subject: 'Wybierz temat wiadomości',
        message: 'Wiadomość musi zawierać co najmniej 10 znaków',
        privacy: 'Musisz wyrazić zgodę na przetwarzanie danych'
    };

    // Real-time validation
    form.addEventListener('input', function(e) {
        validateField(e.target);
    });

    form.addEventListener('change', function(e) {
        if (e.target.type === 'checkbox') {
            validateField(e.target);
        }
    });

    function validateField(field) {
        const fieldName = field.name;
        const value = field.type === 'checkbox' ? field.checked : field.value;
        const isValid = validators[fieldName] ? validators[fieldName](value) : true;

        const errorElement = field.parentElement.querySelector('.error-message');

        if (isValid) {
            field.classList.remove('error');
            field.classList.add('success');
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.classList.add('hidden');
            }
        } else {
            field.classList.remove('success');
            field.classList.add('error');
            if (errorElement && errorMessages[fieldName]) {
                errorElement.textContent = errorMessages[fieldName];
                errorElement.classList.remove('hidden');
            }
        }

        return isValid;
    }

    function validateForm() {
        let isValid = true;
        const formData = new FormData(form);

        Object.keys(validators).forEach(fieldName => {
            const field = form.querySelector(`[name="${fieldName}"]`);
            if (field && !validateField(field)) {
                isValid = false;
            }
        });

        return isValid;
    }

    function showMessage(type, message) {
        formMessage.className = `form-message p-4 rounded-lg mb-6 ${type}`;
        formMessage.querySelector('.message-text').textContent = message;
        formMessage.classList.remove('hidden');

        // Auto hide after 5 seconds
        setTimeout(() => {
            formMessage.classList.add('hidden');
        }, 5000);
    }

    function setLoading(loading) {
        submitBtn.disabled = loading;
        if (loading) {
            buttonText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
        } else {
            buttonText.classList.remove('hidden');
            loadingSpinner.classList.add('hidden');
        }
    }

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!validateForm()) {
            showMessage('error', 'Proszę poprawić błędy w formularzu');
            return;
        }

        setLoading(true);

        try {
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);

            // Simulate API call - replace with actual endpoint
            await new Promise(resolve => setTimeout(resolve, 2000));

            // Success
            showMessage('success', 'Dziękujemy! Wiadomość została wysłana. Skontaktujemy się z Tobą w ciągu 24 godzin.');
            form.reset();

            // Remove validation classes
            form.querySelectorAll('.form-input').forEach(input => {
                input.classList.remove('success', 'error');
            });

        } catch (error) {
            showMessage('error', 'Wystąpił błąd podczas wysyłania wiadomości. Spróbuj ponownie.');
        } finally {
            setLoading(false);
        }
    });

    // Smooth animations on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = '0.2s';
                entry.target.classList.add('animate-fade-in');
            }
        });
    });

    observer.observe(document.querySelector('.contact-form-container'));
});
</script>
@endpush