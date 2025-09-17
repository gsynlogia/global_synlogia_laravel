{{-- Contact Form & Company Data Section --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Contact Form --}}
            <div class="contact-form bg-white p-8 rounded-2xl shadow-lg">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Napisz do Nas</h2>

                <div id="form-status" class="hidden mb-6 p-4 rounded-lg"></div>

                <form id="contact-form" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">
                                Imię *
                            </label>
                            <input
                                type="text"
                                id="firstName"
                                name="firstName"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0056bc] focus:border-transparent"
                                placeholder="Twoje imię"
                            />
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">
                                Nazwisko *
                            </label>
                            <input
                                type="text"
                                id="lastName"
                                name="lastName"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0056bc] focus:border-transparent"
                                placeholder="Twoje nazwisko"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email *
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0056bc] focus:border-transparent"
                            placeholder="twoj@email.com"
                        />
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Telefon
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0056bc] focus:border-transparent"
                            placeholder="+48 123 456 789"
                        />
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                            Firma
                        </label>
                        <input
                            type="text"
                            id="company"
                            name="company"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0056bc] focus:border-transparent"
                            placeholder="Nazwa firmy"
                        />
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                            Temat *
                        </label>
                        <select
                            id="subject"
                            name="subject"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0056bc] focus:border-transparent"
                        >
                            <option value="">Wybierz temat</option>
                            <option value="web-development">Aplikacje Webowe</option>
                            <option value="mobile-apps">Aplikacje Mobilne</option>
                            <option value="hosting">Hosting & Infrastruktura</option>
                            <option value="cloud-services">Usługi Chmurowe</option>
                            <option value="data-management">Zarządzanie Danymi</option>
                            <option value="security">Bezpieczeństwo IT</option>
                            <option value="other">Inne</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Wiadomość *
                        </label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0056bc] focus:border-transparent resize-vertical"
                            placeholder="Opisz swój projekt lub zadaj pytanie..."
                        ></textarea>
                    </div>

                    <div class="flex items-center">
                        <input
                            id="privacy"
                            name="privacy"
                            type="checkbox"
                            required
                            class="h-4 w-4 text-[#0056bc] focus:ring-[#0056bc] border-gray-300 rounded"
                        />
                        <label for="privacy" class="ml-2 block text-sm text-gray-700">
                            Zgadzam się na przetwarzanie moich danych osobowych *
                        </label>
                    </div>

                    <button
                        type="submit"
                        id="submit-btn"
                        class="w-full bg-[#0056bc] hover:bg-blue-800 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-semibold py-4 px-6 rounded-lg transition-all duration-300 hover:scale-105 cursor-pointer"
                    >
                        Wyślij Wiadomość
                    </button>
                </form>
            </div>

            {{-- Company Data --}}
            <div class="space-y-8">
                <div class="company-data bg-white p-8 rounded-2xl shadow-lg">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Dane Firmowe</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="font-medium text-gray-700">Nazwa Firmy:</span>
                            <span class="text-gray-900 font-semibold">GLOBAL-SYNLOGIA Szymon Guzik</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="font-medium text-gray-700">NIP:</span>
                            <span class="text-gray-900 font-semibold">253-017-69-43</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="font-medium text-gray-700">REGON:</span>
                            <span class="text-gray-900 font-semibold">542554138</span>
                        </div>
                    </div>
                </div>

                {{-- Map Placeholder --}}
                <div class="location-map bg-white p-8 rounded-2xl shadow-lg">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Lokalizacja</h3>
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <div class="text-4xl mb-2">📍</div>
                            <p class="font-medium">ul. Władysława Jagiełły 2/20</p>
                            <p>80-180 Gdańsk</p>
                            <p class="text-sm mt-2">(Mapa Google Maps)</p>
                        </div>
                    </div>
                </div>

                {{-- Quick Contact Buttons --}}
                <div class="quick-contact grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a
                        href="tel:+48663583950"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-6 rounded-lg text-center transition-all duration-300 hover:scale-105 cursor-pointer flex items-center justify-center"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path>
                        </svg>
                        Zadzwoń Teraz
                    </a>
                    <a
                        href="mailto:kontakt@globalsynlogia.com"
                        class="bg-[#0056bc] hover:bg-blue-800 text-white font-semibold py-4 px-6 rounded-lg text-center transition-all duration-300 hover:scale-105 cursor-pointer flex items-center justify-center"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                        </svg>
                        Wyślij Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('style_contact_form_section')
<style>
.contact-form {
    animation: fadeSlideUp 0.8s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

.company-data {
    animation: fadeSlideUp 0.8s ease-out 0.2s forwards;
    opacity: 0;
    transform: translateY(30px);
}

.location-map {
    animation: fadeSlideUp 0.8s ease-out 0.4s forwards;
    opacity: 0;
    transform: translateY(30px);
}

.quick-contact {
    animation: fadeSlideUp 0.8s ease-out 0.6s forwards;
    opacity: 0;
    transform: translateY(30px);
}

@keyframes fadeSlideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.contact-form:hover,
.company-data:hover,
.location-map:hover {
    transform: translateY(-2px);
    transition: transform 0.3s ease;
}

/* Form field focus effects */
input:focus,
select:focus,
textarea:focus {
    box-shadow: 0 0 0 3px rgba(0, 86, 188, 0.1);
}

/* Submit button hover effect */
#submit-btn:hover:not(:disabled) {
    box-shadow: 0 10px 20px rgba(0, 86, 188, 0.3);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .contact-form,
    .company-data,
    .location-map {
        padding: 1.5rem;
    }

    .quick-contact {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@push('script_contact_form_section')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const statusDiv = document.getElementById('form-status');
    const submitBtn = document.getElementById('submit-btn');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.textContent = 'Wysyłanie...';
        showStatus('loading', 'Wysyłanie wiadomości...');

        try {
            const formData = new FormData(form);
            const data = {
                name: `${formData.get('firstName')} ${formData.get('lastName')}`.trim(),
                email: formData.get('email'),
                phone: formData.get('phone'),
                subject: formData.get('subject') || 'Kontakt z strony internetowej',
                message: `${formData.get('message')}${formData.get('company') ? `\n\nFirma: ${formData.get('company')}` : ''}`
            };

            const response = await fetch('http://localhost:8001/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                showStatus('success', result.message || 'Wiadomość została wysłana pomyślnie!');
                form.reset();
            } else {
                throw new Error(result.detail || 'Błąd podczas wysyłania wiadomości');
            }
        } catch (error) {
            showStatus('error', error.message || 'Wystąpił nieoczekiwany błąd');
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.textContent = 'Wyślij Wiadomość';
        }
    });

    function showStatus(type, message) {
        statusDiv.textContent = message;
        statusDiv.className = `mb-6 p-4 rounded-lg ${
            type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' :
            type === 'error' ? 'bg-red-100 text-red-800 border border-red-200' :
            'bg-blue-50 text-[#0056bc] border border-blue-200'
        }`;
        statusDiv.classList.remove('hidden');

        if (type === 'success') {
            setTimeout(() => {
                statusDiv.classList.add('hidden');
            }, 5000);
        }
    }

    // Add smooth animations to quick contact buttons
    const quickContactButtons = document.querySelectorAll('.quick-contact a');
    quickContactButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
</script>
@endpush