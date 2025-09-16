@extends('layouts.app')

@section('title', 'O firmie - Global Synlogia')

@section('content')
<div class="min-h-screen bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">O firmie Global Synlogia</h1>
            <p class="text-xl text-gray-600">Kompleksowe rozwiązania IT dla Twojego biznesu</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Nasza misja</h2>
            <p class="text-gray-700 mb-4">
                Global Synlogia to nowoczesna firma technologiczna, która specjalizuje się w dostarczaniu
                kompleksowych rozwiązań IT dla przedsiębiorstw każdej wielkości. Nasza misja to wspieranie
                rozwoju biznesu poprzez implementację najnowszych technologii.
            </p>
            <p class="text-gray-700">
                Oferujemy szeroki zakres usług - od tworzenia aplikacji webowych i mobilnych, przez rozwiązania
                chmurowe, aż po zaawansowane systemy sztucznej inteligencji.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Nasze wartości</h3>
                <ul class="text-gray-700 space-y-2">
                    <li>• Innowacyjność i kreatywność</li>
                    <li>• Najwyższa jakość wykonania</li>
                    <li>• Terminowość i profesjonalizm</li>
                    <li>• Długotrwałe partnerstwa</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Dlaczego my?</h3>
                <ul class="text-gray-700 space-y-2">
                    <li>• Doświadczony zespół ekspertów</li>
                    <li>• Najnowsze technologie</li>
                    <li>• Indywidualne podejście</li>
                    <li>• Wsparcie 24/7</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection