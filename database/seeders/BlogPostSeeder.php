<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BlogPostSeeder extends Seeder
{
    /**
     * Uruchomienie seedera przykładowych artykułów blogowych
     */
    public function run(): void
    {
        // Sprawdzenie czy istnieje użytkownik admin
        $admin = User::where('is_admin', true)->first();

        if (!$admin) {
            // Tworzenie użytkownika admin jeśli nie istnieje
            $admin = User::create([
                'name' => 'Administrator',
                'email' => 'admin@globalsynlogia.pl',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
        }

        // Artykuł 1: Kompletny artykuł z obrazem
        BlogPost::create([
            'title' => 'Witamy w nowym systemie blogowym Global Synlogia',
            'slug' => 'witamy-w-nowym-systemie-blogowym',
            'excerpt' => 'Przedstawiamy nowy system blogowy Global Synlogia z zaawansowanymi funkcjami zarządzania treścią, systemem komentarzy i możliwością ochrony artykułów hasłem.',
            'content' => "Jesteśmy dumni z prezentacji nowego systemu blogowego Global Synlogia, który został zaprojektowany z myślą o maksymalnej funkcjonalności i łatwości użytkowania.

**Kluczowe funkcje systemu:**

• **Zaawansowany edytor treści** - Intuicyjny interfejs do tworzenia i edytowania artykułów
• **System kategorii i tagów** - Lepsze organizowanie treści
• **Ochrona hasłem** - Możliwość tworzenia artykułów dla określonych odbiorców
• **Upload obrazów** - Wsparcie dla lokalnych plików i linków zewnętrznych
• **SEO optymalizacja** - Meta tagi, slugi URL i optymalizacja dla wyszukiwarek
• **System komentarzy** - Interakcja z czytelnikami
• **Responsywny design** - Doskonałe wyświetlanie na wszystkich urządzeniach

Nasz zespół programistów pracował intensywnie przez ostatnie miesiące, aby dostarczyć Państwu narzędzie, które spełni wszystkie oczekiwania w zakresie profesjonalnego prowadzenia bloga firmowego.

Zapraszamy do eksploracji nowych możliwości!",
            'featured_image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'featured_image_is_url' => true,
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'published_at' => now()->subDays(1),
            'author_id' => $admin->id,
            'views_count' => 145,
            'meta_title' => 'Nowy system blogowy Global Synlogia - Zaawansowane funkcje',
            'meta_description' => 'Poznaj nowy system blogowy Global Synlogia z funkcjami ochrony hasłem, SEO, upload obrazów i responsywnym designem.',
            'meta_keywords' => ['blog', 'cms', 'global synlogia', 'system zarządzania treścią', 'seo']
        ]);

        // Artykuł 2: Artykuł techniczny
        BlogPost::create([
            'title' => 'Laravel 11: Nowości i najlepsze praktyki programowania',
            'slug' => 'laravel-11-nowosci-najlepsze-praktyki',
            'excerpt' => 'Przegląd najważniejszych nowości w Laravel 11 oraz sprawdzone praktyki programowania, które zwiększą wydajność Twoich aplikacji webowych.',
            'content' => "Laravel 11 wprowadza szereg ulepszeń, które czynią ten framework jeszcze bardziej potężnym narzędziem dla programistów.

**Najważniejsze nowości w Laravel 11:**

1. **Ulepszona wydajność Eloquent ORM**
   - Optymalizacja zapytań SQL
   - Lepsze cache'owanie relacji
   - Nowe metody agregacyjne

2. **Rozszerzone możliwości Blade**
   - Nowe dyrektywy @pushOnce i @pushIf
   - Lepsze debugging szablonów
   - Optymalizacja kompilacji

3. **Ulepszenia w systemie kolejek**
   - Nowy driver dla Redis Cluster
   - Lepsze monitorowanie zadań
   - Automatyczne retry z eksponencjalnym backoff

4. **Bezpieczeństwo**
   - Rozszerzone funkcje hashowania
   - Nowe middleware do ochrony CSRF
   - Ulepszona weryfikacja HTTPS

**Najlepsze praktyki:**

- Używaj Service Providers do organizacji kodu
- Implementuj Repository Pattern dla złożonej logiki biznesowej
- Korzystaj z Event/Listener pattern dla luźno powiązanych funkcji
- Regularnie aktualizuj dependencies i przeprowadzaj testy bezpieczeństwa

Te ulepszenia czynią Laravel 11 idealnym wyborem dla projektów enterprise.",
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'published_at' => now()->subDays(3),
            'author_id' => $admin->id,
            'views_count' => 89,
            'meta_title' => 'Laravel 11 - Nowości i praktyki programowania | Global Synlogia',
            'meta_description' => 'Kompleksowy przewodnik po Laravel 11: nowości, ulepszenia wydajności, bezpieczeństwo i najlepsze praktyki programowania.',
            'meta_keywords' => ['laravel', 'php', 'programowanie', 'web development', 'framework']
        ]);

        // Artykuł 3: Chroniony hasłem
        BlogPost::create([
            'title' => 'Poufne: Strategia rozwoju firmy na 2025 rok',
            'slug' => 'strategia-rozwoju-firmy-2025',
            'excerpt' => 'Szczegółowy plan rozwoju Global Synlogia na nadchodzący rok z planami ekspansji, nowymi usługami i strategicznymi partnerstwami.',
            'content' => "**DOKUMENT POUFNY - TYLKO DLA ZESPOŁU**

Niniejszy dokument zawiera strategiczne informacje dotyczące planów rozwoju Global Synlogia na 2025 rok.

**Cele strategiczne:**

1. **Ekspansja geograficzna**
   - Otwarcie biura w Krakowie (Q2 2025)
   - Eksploracja rynku niemieckiego (Q3 2025)
   - Partnerstwa w regionie CEE

2. **Nowe usługi**
   - Platforma e-commerce SaaS
   - Usługi AI i Machine Learning
   - Konsulting w zakresie transformacji cyfrowej

3. **Zespół**
   - Zwiększenie zespołu o 40% (planowane 25 nowych osób)
   - Program praktyk dla studentów
   - Inwestycje w szkolenia i certyfikacje

4. **Technologie**
   - Migracja infrastruktury do chmury
   - Implementacja microservices
   - Rozwój kompetencji w React Native i Flutter

**Budżet i finansowanie:**
Szczegóły finansowe zostały omówione w osobnym dokumencie dla zarządu.

**Harmonogram realizacji:**
Szczegółowy harmonogram będzie dostępny w systemie zarządzania projektami.",
            'password' => 'firma2025',
            'is_password_protected' => true,
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'published_at' => now()->subHours(6),
            'author_id' => $admin->id,
            'views_count' => 12,
            'meta_title' => 'Strategia rozwoju firmy - dokument wewnętrzny',
            'meta_description' => 'Poufny dokument strategiczny Global Synlogia na 2025 rok.',
        ]);

        // Artykuł 4: Draft - nieopublikowany
        BlogPost::create([
            'title' => 'Jak wybrać najlepszy hosting dla aplikacji Laravel',
            'slug' => 'jak-wybrac-hosting-dla-laravel',
            'excerpt' => 'Kompleksowy poradnik wyboru hostingu dla aplikacji Laravel z uwzględnieniem wydajności, bezpieczeństwa i kosztów.',
            'content' => "**SZKIC ARTYKUŁU - DO UZUPEŁNIENIA**

Ten artykuł będzie zawierał szczegółowy przegląd opcji hostingowych dla aplikacji Laravel.

**Planowana struktura:**

1. Wymagania techniczne Laravel
2. Porównanie różnych typów hostingu
3. Rekomendowane providery
4. Konfiguracja środowiska produkcyjnego
5. Monitorowanie i optymalizacja

**Do dodania:**
- Screenshoty z paneli administracyjnych
- Benchmarki wydajności
- Przykłady konfiguracji
- Case studies z real-world projektów

**Deadline:** 15.01.2025",
            'status' => BlogPost::STATUS_DRAFT,
            'is_enabled' => true,
            'author_id' => $admin->id,
            'views_count' => 0,
        ]);

        // Artykuł 5: Z datą publikacji w przyszłości
        BlogPost::create([
            'title' => 'Trendy w web developmencie na 2025 rok',
            'slug' => 'trendy-web-development-2025',
            'excerpt' => 'Analiza najważniejszych trendów w web developmencie, które będą kształtować branżę w 2025 roku: AI, Web3, serverless i nie tylko.',
            'content' => "Rok 2025 zapowiada się jako przełomowy dla branży web developmentu. Oto najważniejsze trendy, które będą kształtować naszą pracę.

**1. Sztuczna Inteligencja w developmencie**
- AI-powered code completion (GitHub Copilot, Tabnine)
- Automatyczne generowanie testów
- AI w code review i bug detection
- Chatboty i asystenci programowania

**2. Serverless Architecture**
- Funkcje jako usługa (FaaS)
- Edge computing
- Micro-frontends
- JAMstack evolution

**3. Web3 i Blockchain**
- Decentralizowane aplikacje (dApps)
- Smart contracts integration
- NFT marketplaces
- Cryptocurrency payments

**4. Performance & User Experience**
- Core Web Vitals optimization
- Progressive Web Apps (PWA) 2.0
- WebAssembly mainstream adoption
- Advanced caching strategies

**5. Developer Experience**
- No-code/Low-code platforms
- Improved DevOps tooling
- Better debugging tools
- Enhanced IDE capabilities

**6. Security**
- Zero-trust architecture
- Advanced authentication methods
- Privacy-first development
- Quantum-safe cryptography preparation

Te trendy będą wymagać od developerów ciągłego uczenia się i adaptacji do nowych technologii.",
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'published_at' => now()->addDays(2), // Publikacja za 2 dni
            'author_id' => $admin->id,
            'views_count' => 0,
            'meta_title' => 'Trendy Web Development 2025 - AI, Serverless, Web3',
            'meta_description' => 'Przewodnik po najważniejszych trendach w web developmencie na 2025: AI, serverless, Web3, performance i bezpieczeństwo.',
            'meta_keywords' => ['web development', 'trendy 2025', 'ai', 'serverless', 'web3', 'blockchain']
        ]);

        // Artykuł 6: Tutorial techniczny
        BlogPost::create([
            'title' => 'Tutorial: Budowanie REST API w Laravel z autentykacją JWT',
            'slug' => 'tutorial-rest-api-laravel-jwt',
            'excerpt' => 'Krok po kroku tutorial tworzenia bezpiecznego REST API w Laravel z wykorzystaniem JSON Web Tokens do autentykacji użytkowników.',
            'content' => "W tym tutorialu nauczysz się tworzyć profesjonalne REST API w Laravel z bezpieczną autentykacją JWT.

**Wymagania wstępne:**
- PHP 8.1+
- Composer
- Laravel 11
- Podstawowa znajomość REST API

**Krok 1: Instalacja Laravel**
```bash
composer create-project laravel/laravel api-tutorial
cd api-tutorial
```

**Krok 2: Instalacja JWT Auth**
```bash
composer require tymon/jwt-auth
php artisan vendor:publish --provider=\"Tymon\\JWTAuth\\Providers\\LaravelServiceProvider\"
php artisan jwt:secret
```

**Krok 3: Konfiguracja modelu User**
```php
use Tymon\\JWTAuth\\Contracts\\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return \$this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
```

**Krok 4: Tworzenie kontrolera Auth**
```php
class AuthController extends Controller
{
    public function login(Request \$request)
    {
        \$credentials = \$request->only('email', 'password');

        if (!\$token = auth()->attempt(\$credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return \$this->respondWithToken(\$token);
    }
}
```

**Krok 5: Definicja routes**
```php
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', 'UserController@index');
    Route::post('/logout', 'AuthController@logout');
});
```

**Testowanie API:**
Użyj Postman lub curl do testowania endpointów:
```bash
curl -X POST http://localhost:8000/api/login \\
-H \"Content-Type: application/json\" \\
-d '{\"email\":\"user@example.com\",\"password\":\"password\"}'
```

**Najlepsze praktyki:**
- Zawsze waliduj dane wejściowe
- Używaj Resource Classes dla formatowania odpowiedzi
- Implementuj rate limiting
- Loguj wszystkie żądania API
- Używaj HTTPS w produkcji

Kompletny kod źródłowy dostępny na GitHub.",
            'featured_image' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'featured_image_is_url' => true,
            'status' => BlogPost::STATUS_PUBLISHED,
            'is_enabled' => true,
            'published_at' => now()->subDays(2),
            'author_id' => $admin->id,
            'views_count' => 234,
            'meta_title' => 'Tutorial REST API Laravel JWT - Krok po kroku',
            'meta_description' => 'Kompletny tutorial tworzenia REST API w Laravel z autentykacją JWT. Kod źródłowy, przykłady i najlepsze praktyki.',
            'meta_keywords' => ['laravel', 'rest api', 'jwt', 'tutorial', 'autentykacja', 'php']
        ]);

        // Generowanie dodatkowych 344 artykułów dla testów (łącznie ~350)
        $this->generateBulkArticles($admin, 344);

        echo "✅ Utworzono ~350 przykładowych artykułów blogowych:\n";
        echo "   • 6 artykułów podstawowych (różne statusy i funkcje)\n";
        echo "   • 344 artykułów generowanych automatycznie\n";
        echo "   • Artykuły obejmują różne kategorie: technologia, biznes, tutoriale\n";
        echo "   • Mix statusów: opublikowane, drafty, chronione hasłem\n\n";
        echo "💡 Hasło do chronionego artykułu: 'firma2025'\n";
        echo "👤 Admin: admin@globalsynlogia.pl / admin123\n";
    }

    /**
     * Generowanie dużej ilości artykułów testowych
     */
    private function generateBulkArticles($admin, $count)
    {
        // Kategorie artykułów
        $categories = [
            'Programowanie' => ['php', 'javascript', 'python', 'java', 'c++', 'programming'],
            'Web Development' => ['html', 'css', 'react', 'vue', 'angular', 'web design'],
            'Bazy Danych' => ['mysql', 'postgresql', 'mongodb', 'database', 'sql'],
            'DevOps' => ['docker', 'kubernetes', 'ci/cd', 'aws', 'azure', 'devops'],
            'Bezpieczeństwo' => ['cybersecurity', 'encryption', 'authentication', 'security'],
            'AI & Machine Learning' => ['artificial intelligence', 'machine learning', 'deep learning', 'ai'],
            'Biznes IT' => ['startup', 'management', 'agile', 'scrum', 'business'],
            'Mobile Development' => ['android', 'ios', 'react native', 'flutter', 'mobile'],
            'Gaming' => ['game development', 'unity', 'unreal', 'gaming', 'graphics'],
            'UI/UX Design' => ['design', 'user experience', 'interface', 'figma', 'adobe']
        ];

        // Obrazy przykładowe z Unsplash
        $sampleImages = [
            'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'
        ];

        // Szablony tytułów
        $titleTemplates = [
            'Jak rozpocząć pracę z {tech}',
            'Najlepsze praktyki {tech} w 2025 roku',
            'Tutorial: {tech} dla początkujących',
            'Zaawansowane techniki {tech}',
            '10 powodów dlaczego warto wybrać {tech}',
            'Porównanie {tech} z alternatywami',
            'Problemy z {tech} i jak je rozwiązać',
            'Przyszłość {tech} - co nas czeka',
            'Case study: {tech} w praktyce',
            'Migracja na {tech} - przewodnik krok po kroku'
        ];

        // Generowanie artykułów
        for ($i = 1; $i <= $count; $i++) {
            $category = array_rand($categories);
            $keywords = $categories[$category];
            $tech = $keywords[array_rand($keywords)];

            $titleTemplate = $titleTemplates[array_rand($titleTemplates)];
            $title = str_replace('{tech}', ucfirst($tech), $titleTemplate);

            // Dodanie unikalnego identyfikatora do tytułu aby uniknąć duplikatów slug
            $title .= " #{$i}";

            // Losowy status (większość opublikowana)
            $statusRandom = rand(1, 100);
            if ($statusRandom <= 75) {
                $status = BlogPost::STATUS_PUBLISHED;
                $publishedAt = now()->subDays(rand(1, 365));
            } elseif ($statusRandom <= 90) {
                $status = BlogPost::STATUS_DRAFT;
                $publishedAt = null;
            } else {
                $status = BlogPost::STATUS_ARCHIVED;
                $publishedAt = now()->subDays(rand(400, 800));
            }

            // Losowe hasło (5% artykułów chronionych)
            $isPasswordProtected = rand(1, 100) <= 5;
            $password = $isPasswordProtected ? 'test' . rand(100, 999) : null;

            // Generowanie treści
            $excerpt = "Artykuł z kategorii {$category} omawiający kluczowe aspekty {$tech}. Przedstawiamy praktyczne porady, najlepsze praktyki i rzeczywiste przykłady użycia.";

            $content = "Ten artykuł omawia {$tech} w kontekście {$category}.

**Wprowadzenie**

{$tech} to jedno z kluczowych narzędzi w dzisiejszym świecie {$category}. W tym artykule przedstawimy kompleksowy przegląd najważniejszych aspektów.

**Kluczowe funkcje:**

• Łatwość użytkowania i intuicyjny interfejs
• Wysoką wydajność i skalowalność
• Bogaty ekosystem bibliotek i narzędzi
• Aktywną społeczność programistów
• Regularne aktualizacje i wsparcie

**Praktyczne zastosowania:**

1. **Rozwój aplikacji** - {$tech} doskonale sprawdza się w tworzeniu nowoczesnych aplikacji
2. **Automatyzacja procesów** - Możliwość automatyzacji rutynowych zadań
3. **Integracja systemów** - Łatwe łączenie z innymi technologiami
4. **Optymalizacja wydajności** - Narzędzia do monitorowania i optymalizacji

**Najlepsze praktyki:**

- Regularnie aktualizuj biblioteki i dependencje
- Stosuj wzorce projektowe odpowiednie dla {$tech}
- Testuj kod przed wdrożeniem na produkcję
- Dokumentuj API i funkcje
- Korzystaj z systemów kontroli wersji

**Podsumowanie**

{$tech} to potężne narzędzie, które może znacznie usprawnić pracę w obszarze {$category}. Przy odpowiednim podejściu i znajomości najlepszych praktyk, można osiągnąć doskonałe rezultaty.

Zachęcamy do eksperymentowania i dalszego pogłębiania wiedzy na temat {$tech}.";

            BlogPost::create([
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title),
                'excerpt' => $excerpt,
                'content' => $content,
                'featured_image' => rand(1, 3) == 1 ? $sampleImages[array_rand($sampleImages)] : null, // 33% artykułów z obrazem
                'featured_image_is_url' => true,
                'status' => $status,
                'is_enabled' => rand(1, 20) != 1, // 95% włączonych
                'published_at' => $publishedAt,
                'author_id' => $admin->id,
                'views_count' => rand(0, 500),
                'password' => $password,
                'is_password_protected' => $isPasswordProtected,
                'meta_title' => $title . ' - Przewodnik Global Synlogia',
                'meta_description' => substr($excerpt, 0, 155),
                'meta_keywords' => array_slice($keywords, 0, 5)
            ]);

            // Progress indicator co 50 artykułów
            if ($i % 50 == 0) {
                echo "   • Wygenerowano {$i}/{$count} artykułów...\n";
            }
        }
    }
}