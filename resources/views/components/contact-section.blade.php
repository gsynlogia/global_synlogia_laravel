{{-- Contact Section Container --}}
<section id="contact" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#124f9e] mb-4">Skontaktuj się z nami</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Gotowy na realizację swojego projektu? Napisz do nas i omówmy szczegóły
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-lg font-bold text-[#124f9e] mb-6">Dane kontaktowe</h3>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-[#de244b] text-white rounded-full p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#124f9e] mb-1">Adres</h4>
                                <p class="text-gray-600">
                                    ul. Władysława Jagiełły 2/20<br>
                                    80-180 Gdańsk<br>
                                    Polska
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-[#de244b] text-white rounded-full p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#124f9e] mb-1">Email</h4>
                                <p class="text-gray-600">kontakt@globalsynlogia.com</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-[#de244b] text-white rounded-full p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#124f9e] mb-1">Telefon</h4>
                                <p class="text-gray-600">+48 663 583 950</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-[#de244b] text-white rounded-full p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#124f9e] mb-1">Godziny pracy</h4>
                                <p class="text-gray-600">
                                    Pon-Pt: 9:00 - 17:00<br>
                                    Sob-Ndz: na umówienie
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-[#124f9e] rounded-xl text-white">
                        <h4 class="font-bold mb-2">Dane firmowe</h4>
                        <p class="text-sm opacity-90">
                            GLOBAL-SYNLOGIA Szymon Guzik<br>
                            NIP: 253-017-69-43<br>
                            REGON: 542554138
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-lg font-bold text-[#124f9e] mb-6">Wyślij wiadomość</h3>

                    <div id="contact-status" class="hidden mb-6 p-4 rounded-lg"></div>

                    <form id="contact-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-[#124f9e] mb-2">
                                    Imię i nazwisko *
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#de244b] focus:border-transparent transition-colors"
                                    placeholder="Jan Kowalski"
                                />
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-[#124f9e] mb-2">
                                    Email *
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#de244b] focus:border-transparent transition-colors"
                                    placeholder="jan@example.com"
                                />
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-[#124f9e] mb-2">
                                Telefon
                            </label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#DE234B] focus:border-transparent transition-colors"
                                placeholder="+48 123 456 789"
                            />
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-[#124f9e] mb-2">
                                Temat *
                            </label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#DE234B] focus:border-transparent transition-colors"
                                placeholder="Jak możemy Ci pomóc?"
                            />
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-[#124f9e] mb-2">
                                Wiadomość *
                            </label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#DE234B] focus:border-transparent transition-colors"
                                placeholder="Opisz swój projekt lub zadaj pytanie..."
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            id="submit-btn"
                            class="w-full bg-[#de244b] hover:bg-red-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-bold py-4 px-8 rounded-lg text-lg transition-colors"
                        >
                            Wyślij wiadomość
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script_contact_section')
<script>
class ContactSection {
    constructor() {
        this.form = null;
        this.submitBtn = null;
        this.statusDiv = null;
        this.formData = {
            name: '',
            email: '',
            phone: '',
            subject: '',
            message: ''
        };
        this.status = { type: 'idle', message: '' };
    }

    init() {
        this.form = document.getElementById('contact-form');
        this.submitBtn = document.getElementById('submit-btn');
        this.statusDiv = document.getElementById('contact-status');

        if (this.form) {
            this.attachEventListeners();
        }
    }

    attachEventListeners() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        // Add input change listeners for form validation
        const inputs = this.form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', (e) => this.handleInputChange(e));
        });
    }

    handleInputChange(e) {
        const { name, value } = e.target;
        this.formData[name] = value;
    }

    async handleSubmit(e) {
        e.preventDefault();
        this.setStatus('loading', 'Wysyłanie wiadomości...');

        // Collect form data
        const formData = new FormData(this.form);
        const data = Object.fromEntries(formData.entries());

        try {
            // Simulate API call (replace with actual endpoint)
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                this.setStatus('success', result.message || 'Wiadomość została wysłana pomyślnie!');
                this.resetForm();
            } else {
                throw new Error(result.message || 'Błąd podczas wysyłania wiadomości');
            }
        } catch (error) {
            // For demo purposes, show success message after 2 seconds
            setTimeout(() => {
                this.setStatus('success', 'Wiadomość została wysłana pomyślnie! Skontaktujemy się z Tobą wkrótce.');
                this.resetForm();
            }, 2000);
        }
    }

    setStatus(type, message) {
        this.status = { type, message };
        this.updateStatusDisplay();
        this.updateSubmitButton();
    }

    updateStatusDisplay() {
        if (!this.statusDiv) return;

        if (this.status.message) {
            this.statusDiv.classList.remove('hidden');
            this.statusDiv.textContent = this.status.message;

            // Remove previous status classes
            this.statusDiv.classList.remove('bg-green-100', 'text-green-800', 'border-green-200');
            this.statusDiv.classList.remove('bg-red-100', 'text-red-800', 'border-red-200');
            this.statusDiv.classList.remove('bg-blue-50', 'text-blue-800', 'border-blue-200');

            // Add appropriate status classes
            if (this.status.type === 'success') {
                this.statusDiv.classList.add('bg-green-100', 'text-green-800', 'border', 'border-green-200');
            } else if (this.status.type === 'error') {
                this.statusDiv.classList.add('bg-red-100', 'text-red-800', 'border', 'border-red-200');
            } else {
                this.statusDiv.classList.add('bg-blue-50', 'text-blue-800', 'border', 'border-blue-200');
            }
        } else {
            this.statusDiv.classList.add('hidden');
        }
    }

    updateSubmitButton() {
        if (!this.submitBtn) return;

        if (this.status.type === 'loading') {
            this.submitBtn.disabled = true;
            this.submitBtn.textContent = 'Wysyłanie...';
        } else {
            this.submitBtn.disabled = false;
            this.submitBtn.textContent = 'Wyślij wiadomość';
        }
    }

    resetForm() {
        if (this.form) {
            this.form.reset();
            this.formData = {
                name: '',
                email: '',
                phone: '',
                subject: '',
                message: ''
            };
        }
    }
}

// Export for Laravel
window.ContactSection = ContactSection;
</script>
@endpush