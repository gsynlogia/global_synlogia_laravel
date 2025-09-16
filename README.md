# Global Synlogia Laravel

<p align="center">
  <img src="public/logo-color.png" alt="Global Synlogia Logo" width="300">
</p>

<p align="center">
  <strong>Kompleksowe rozwiązania IT dla Twojego biznesu</strong>
</p>

## O Projekcie

Global Synlogia Laravel to nowoczesna aplikacja webowa zbudowana w oparciu o framework Laravel z wykorzystaniem Tailwind CSS. Projekt oferuje modularną architekturę komponentów oraz responsywny design zapewniający doskonałe doświadczenie użytkownika.

### Główne Funkcjonalności

- **Modularny system komponentów** - wykorzystanie Laravel Blade z dyrektywami @push/@stack
- **Responsywny design** - pełna kompatybilność z urządzeniami mobilnymi
- **Animacje CSS** - płynne przejścia i efekty wizualne
- **Offline-first** - wszystkie zasoby przechowywane lokalnie
- **Badge Slider** - animowany slider z technologiami
- **Sekcja usług** - prezentacja głównych usług firmy

### Technologie

- **Backend**: Laravel 11.x
- **Frontend**: Tailwind CSS 3.4.1
- **Build Tool**: Vite
- **Fonty**: Instrument Sans (lokalne)
- **JavaScript**: Vanilla JS z modularną architekturą

## Instalacja i Uruchomienie

### Wymagania

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- npm lub yarn

### Kroki instalacji

1. **Sklonuj repozytorium**
   ```bash
   git clone git@github.com-global:gsynlogia/global_synlogia_laravel.git
   cd global_synlogia_laravel
   ```

2. **Zainstaluj zależności PHP**
   ```bash
   composer install
   ```

3. **Zainstaluj zależności JavaScript**
   ```bash
   npm install
   ```

4. **Utwórz plik środowiskowy**
   ```bash
   cp .env.example .env
   ```

5. **Wygeneruj klucz aplikacji**
   ```bash
   php artisan key:generate
   ```

### Uruchomienie projektu

1. **Uruchom serwer Laravel**
   ```bash
   php artisan serve --port=8002
   ```

2. **Uruchom Vite (w osobnym terminalu)**
   ```bash
   npm run dev
   ```

3. **Otwórz przeglądarkę**
   ```
   http://localhost:8002
   ```

### Uruchomienie w trybie produkcyjnym

1. **Zbuduj zasoby dla produkcji**
   ```bash
   npm run build
   ```

2. **Uruchom serwer**
   ```bash
   php artisan serve --port=8002
   ```

## Struktura Projektu

```
├── resources/views/
│   ├── components/          # Komponenty Blade
│   │   ├── info-banner.blade.php
│   │   ├── navigation.blade.php
│   │   └── badge-slider.blade.php
│   └── home.blade.php       # Główny widok
├── public/
│   ├── css/                 # Style CSS
│   ├── js/                  # Pliki JavaScript
│   ├── fonts/               # Fonty lokalne
│   └── logo-color.png       # Logo firmy
├── resources/css/           # Źródła CSS
└── resources/js/            # Źródła JavaScript
```

## Architektura Komponentów

Projekt wykorzystuje modularną architekturę z wykorzystaniem Laravel Blade:

- **@push/@stack** - zarządzanie stylami i skryptami komponentów
- **@include** - włączanie komponentów do głównego widoku
- **Namespace naming** - unikalne klucze dla każdego komponentu

### Przykład komponentu

```blade
{{-- Komponent --}}
<div class="component">
    <!-- Zawartość komponentu -->
</div>

@push('style_component_name')
<style>
    /* Style komponentu */
</style>
@endpush

@push('script_component_name')
<script>
    // JavaScript komponentu
</script>
@endpush
```

## Dostępne Komendy

- `php artisan serve` - uruchomienie serwera deweloperskiego
- `npm run dev` - uruchomienie Vite w trybie deweloperskim
- `npm run build` - budowanie zasobów dla produkcji
- `composer install` - instalacja zależności PHP
- `npm install` - instalacja zależności JavaScript

## Wsparcie

W przypadku problemów lub pytań, skontaktuj się z zespołem Global Synlogia.

---

<p align="center">
  Zbudowane z ❤️ przez <strong>Global Synlogia</strong>
</p>