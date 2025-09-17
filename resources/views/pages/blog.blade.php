@extends('layouts.app')

@section('title', 'Blog Techniczny - Global Synlogia')

@section('content')
{{-- Blog Page Container --}}
<div class="container mx-auto px-4 py-16">
    {{-- Header Section --}}
    <div class="text-center mb-16">
        <h1 class="text-2xl md:text-3xl font-bold text-[#124f9e] mb-6">
            Blog Techniczny
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Najnowsze trendy, najlepsze praktyki i zaawansowane techniki w świecie programowania i technologii
        </p>
    </div>

    {{-- Filters Section --}}
    <div class="flex flex-col md:flex-row gap-4 mb-12">
        {{-- Search --}}
        <div class="flex-1">
            <input
                type="text"
                placeholder="Szukaj artykułów..."
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#124f9e] focus:border-[#124f9e]"
            />
        </div>

        {{-- Category Filter --}}
        <div class="md:w-64">
            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#124f9e] focus:border-[#124f9e]">
                <option>Wszystkie kategorie</option>
                <option>Python</option>
                <option>Docker</option>
                <option>TypeScript</option>
                <option>Web Development</option>
                <option>Programowanie</option>
            </select>
        </div>
    </div>

    {{-- Results Summary --}}
    <div class="mb-8">
        <p class="text-gray-600">Znaleziono 6 artykułów</p>
    </div>

    {{-- Blog Posts Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">

        {{-- Article 1: Python - Keras, Pandas, Numpy --}}
        <article class="bg-white rounded-lg shadow-md hover:shadow-lg cursor-pointer transition-all duration-300">
            <div class="relative overflow-hidden rounded-t-lg">
                <img
                    src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Python - Keras, Pandas, Numpy"
                    class="w-full h-48 object-cover"
                />
                <div class="absolute top-3 left-3">
                    <span class="bg-[#de244b] text-white px-3 py-1 rounded text-sm font-medium">Wyróżniony</span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-[#de244b] transition-colors">
                    Python - Keras, Pandas, Numpy - tak poproszę - czyli rozpoznawanie obrazów dla każdego
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Naucz się budować modele rozpoznawania obrazów w Pythonie! Ten artykuł krok po kroku przeprowadzi Cię przez proces tworzenia prostego, ale funkcjonalnego modelu wykorzystującego Keras, Pandas i NumPy. Idealne dla programistów chcących wejść w świat uczenia maszynowego.
                </p>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Autor: Admin • 1 min czytania</span>
                    <span>15 września 2024</span>
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    5 wyświetleń
                </div>
            </div>
        </article>

        {{-- Article 2: Docker - Podstawy konteneryzacji --}}
        <article class="bg-white rounded-lg shadow-md hover:shadow-lg cursor-pointer transition-all duration-300">
            <div class="relative overflow-hidden rounded-t-lg">
                <img
                    src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Docker - Podstawy konteneryzacji"
                    class="w-full h-48 object-cover"
                />
                <div class="absolute top-3 left-3">
                    <span class="bg-[#124f9e] text-white px-3 py-1 rounded text-sm font-medium">Docker</span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-[#de244b] transition-colors">
                    Docker - Podstawy konteneryzacji
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Dowiedz się jak Docker upraszcza rozwój i wdrażanie aplikacji. Artykuł omawia podstawy konteneryzacji, Dockerfile, Docker Compose oraz najlepsze praktyki konteneryzacji obrazów i uruchamiania kontenerów Docker.
                </p>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Autor: Admin • 1 min czytania</span>
                    <span>8 września 2024</span>
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    643 wyświetleń
                </div>
            </div>
        </article>

        {{-- Article 3: TypeScript - Zaawansowane typy --}}
        <article class="bg-white rounded-lg shadow-md hover:shadow-lg cursor-pointer transition-all duration-300">
            <div class="relative overflow-hidden rounded-t-lg">
                <img
                    src="https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="TypeScript - Zaawansowane typy"
                    class="w-full h-48 object-cover"
                />
                <div class="absolute top-3 left-3">
                    <span class="bg-[#124f9e] text-white px-3 py-1 rounded text-sm font-medium">TypeScript</span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-[#de244b] transition-colors">
                    TypeScript - Zaawansowane typy
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Ten artykuł omawia zaawansowane typy w TypeScript, takie jak typy warunkowe, generyczne, interfejsy oraz mapped types. Dowiedz się jak wykorzystać potężne narzędzia do budowania type-safe aplikacji w sposób efektywny.
                </p>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Autor: Admin • 1 min czytania</span>
                    <span>22 września 2024</span>
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    558 wyświetleń
                </div>
            </div>
        </article>

        {{-- Article 4: React 18 - Nowości i funkcje --}}
        <article class="bg-white rounded-lg shadow-md hover:shadow-lg cursor-pointer transition-all duration-300">
            <div class="relative overflow-hidden rounded-t-lg">
                <img
                    src="https://images.unsplash.com/photo-1633356122102-3fe601e05bd2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="React 18 - Nowości i funkcje"
                    class="w-full h-48 object-cover"
                />
                <div class="absolute top-3 left-3">
                    <span class="bg-[#de244b] text-white px-3 py-1 rounded text-sm font-medium">Web Development</span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-[#de244b] transition-colors">
                    React 18 - Nowości i funkcje
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    React 18 wprowadza rewolucyjne zmiany: Concurrent Mode dla lepszej responsywności, Suspense dla komponentów serwera oraz automatic batching. Dowiedz się jak te nowości zmienią rozwój aplikacji, usprawnia responsywność oraz pozwolą na lepszą wydajność aplikacji.
                </p>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Autor: Admin • 1 min czytania</span>
                    <span>10 września 2024</span>
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    1243 wyświetleń
                </div>
            </div>
        </article>

        {{-- Article 5: Next.js App Router - Nowa era w React --}}
        <article class="bg-white rounded-lg shadow-md hover:shadow-lg cursor-pointer transition-all duration-300">
            <div class="relative overflow-hidden rounded-t-lg">
                <img
                    src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Next.js App Router - Nowa era w React"
                    class="w-full h-48 object-cover"
                />
                <div class="absolute top-3 left-3">
                    <span class="bg-[#de244b] text-white px-3 py-1 rounded text-sm font-medium">Web Development</span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-[#de244b] transition-colors">
                    Next.js App Router - Nowa era w React
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Next.js App Router to rewolucja w świecie React. Nowa architektura routing umożliwia hierarchiczny routing, łatwiejsze zarządzanie danymi oraz potężne możliwości server-side rendering.
                </p>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Autor: Admin • 1 min czytania</span>
                    <span>8 września 2024</span>
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    423 wyświetleń
                </div>
            </div>
        </article>

        {{-- Article 6: Python FastAPI - Szybkie API w praktyce --}}
        <article class="bg-white rounded-lg shadow-md hover:shadow-lg cursor-pointer transition-all duration-300">
            <div class="relative overflow-hidden rounded-t-lg">
                <img
                    src="https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Python FastAPI - Szybkie API w praktyce"
                    class="w-full h-48 object-cover"
                />
                <div class="absolute top-3 left-3">
                    <span class="bg-[#124f9e] text-white px-3 py-1 rounded text-sm font-medium">Programowanie</span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-[#de244b] transition-colors">
                    Python FastAPI - Szybkie API w praktyce
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Python FastAPI to nowoczesny framework do tworzenia szybkich i skałowalnych API. Artykuł omawia instalację, konfigurację, tworzenie prostych aplikacji oraz best practices w zakresie bezpieczeństwa i wydajności.
                </p>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Autor: Admin • 1 min czytania</span>
                    <span>9 września 2024</span>
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    876 wyświetleń
                </div>
            </div>
        </article>

    </div>
</div>
@endsection

@push('styles')
<style>
/* Blog post cards animations */
.grid > article {
    animation: fadeSlideUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
}

.grid > article:nth-child(1) { animation-delay: 0.1s; }
.grid > article:nth-child(2) { animation-delay: 0.2s; }
.grid > article:nth-child(3) { animation-delay: 0.3s; }
.grid > article:nth-child(4) { animation-delay: 0.4s; }
.grid > article:nth-child(5) { animation-delay: 0.5s; }
.grid > article:nth-child(6) { animation-delay: 0.6s; }

@keyframes fadeSlideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover effects */
.grid > article:hover {
    transform: translateY(-4px);
}

.grid > article:hover h3 {
    color: #de244b;
}

/* Line clamp for descriptions */
.grid > article p {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Hero section animations */
h1 {
    animation: fadeSlideUp 1s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

h1 + p {
    animation: fadeSlideUp 1s ease-out 0.2s forwards;
    opacity: 0;
    transform: translateY(30px);
}

/* Filter section animations */
.flex.flex-col.md\\:flex-row {
    animation: fadeSlideUp 0.8s ease-out 0.4s forwards;
    opacity: 0;
    transform: translateY(20px);
}

/* Results summary animation */
.mb-8 > p {
    animation: fadeSlideUp 0.8s ease-out 0.6s forwards;
    opacity: 0;
    transform: translateY(20px);
}
</style>
@endpush