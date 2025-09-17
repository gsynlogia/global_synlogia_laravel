@extends('layouts.app')

@section('title', 'Panel Administracyjny - Global Synlogia')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-[#124f9e]">Panel Administracyjny</h1>
                    <p class="text-gray-600 mt-2">Zarządzanie systemem Global Synlogia</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="flex items-center px-3 py-2 bg-[#de244b] text-white rounded-lg text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Superuser
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-[#124f9e] rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-[#124f9e]">{{ \App\Models\User::count() }}</div>
                            <div class="text-sm text-gray-600">Użytkownicy</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-[#de244b] rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-[#de244b]">{{ count(\App\Models\User::getSuperuserEmails()) }}</div>
                            <div class="text-sm text-gray-600">Superuserzy</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-orange-500">{{ \App\Models\Role::count() }}</div>
                            <div class="text-sm text-gray-600">Role</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-green-500">{{ \App\Models\Permission::count() }}</div>
                            <div class="text-sm text-gray-600">Uprawnienia</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18 21l-2.25-2.25m0 0L21 12l-9-9-9 9 6.75 6.75"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-bold text-purple-500">{{ \App\Models\User::blocked()->count() }}</div>
                            <div class="text-sm text-gray-600">Zablokowani</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Superusers List -->
        <div class="bg-white shadow-lg rounded-lg mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Superuserzy (zahardkodowani w .env)</h3>
                <p class="text-sm text-gray-600 mt-1">Ci użytkownicy mają zawsze uprawnienia administratora</p>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach(\App\Models\User::getSuperuserEmails() as $email)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-[#de244b] rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $email }}</div>
                                    @php $user = \App\Models\User::where('email', $email)->first(); @endphp
                                    @if($user)
                                        <div class="text-xs text-green-600">Zarejestrowany jako: {{ $user->name }}</div>
                                    @else
                                        <div class="text-xs text-gray-500">Nie zarejestrowany w systemie</div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#de244b] text-white">
                                    Superuser
                                </span>
                                @if($user && $user->email === auth()->user()->email)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#124f9e] text-white">
                                        To Ty
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ACL Management -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-[#124f9e]">Zarządzanie systemem ACL</h3>
                <p class="text-sm text-gray-600 mt-1">Kompletne zarządzanie użytkownikami, rolami i uprawnieniami</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Users Management -->
                    <a href="{{ route('admin.users.index') }}" class="admin-card group p-4 bg-[#124f9e] text-white rounded-lg hover:bg-[#0f3f85] transition-all duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            <span class="text-2xl font-bold">{{ \App\Models\User::count() }}</span>
                        </div>
                        <h4 class="text-sm font-medium mb-1">Zarządzanie użytkownikami</h4>
                        <p class="text-xs opacity-80">Tworzenie, edycja, blokowanie i usuwanie użytkowników</p>
                        <div class="mt-3 flex items-center text-xs">
                            <span>Przejdź do modułu</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                    <!-- Roles Management -->
                    <a href="{{ route('admin.roles.index') }}" class="admin-card group p-4 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="text-2xl font-bold">{{ \App\Models\Role::count() }}</span>
                        </div>
                        <h4 class="text-sm font-medium mb-1">Zarządzanie rolami</h4>
                        <p class="text-xs opacity-80">Tworzenie i edycja ról oraz przypisywanie uprawnień</p>
                        <div class="mt-3 flex items-center text-xs">
                            <span>Przejdź do modułu</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                    <!-- Permissions Management -->
                    <a href="{{ route('admin.permissions.index') }}" class="admin-card group p-4 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span class="text-2xl font-bold">{{ \App\Models\Permission::count() }}</span>
                        </div>
                        <h4 class="text-sm font-medium mb-1">Zarządzanie uprawnieniami</h4>
                        <p class="text-xs opacity-80">Tworzenie i edycja uprawnień systemowych</p>
                        <div class="mt-3 flex items-center text-xs">
                            <span>Przejdź do modułu</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                    <!-- Trash Management -->
                    <a href="{{ route('admin.users.trash') }}" class="admin-card group p-4 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-all duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span class="text-2xl font-bold">{{ \App\Models\User::onlyTrashed()->count() }}</span>
                        </div>
                        <h4 class="text-sm font-medium mb-1">Kosz (soft delete)</h4>
                        <p class="text-xs opacity-80">Przywracanie i trwałe usuwanie elementów</p>
                        <div class="mt-3 flex items-center text-xs">
                            <span>Przejdź do modułu</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                </div>

                <!-- Quick Stats -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-[#124f9e]">{{ \App\Models\User::active()->count() }}</div>
                            <div class="text-xs text-gray-600">Aktywni użytkownicy</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-[#de244b]">{{ \App\Models\User::admins()->count() }}</div>
                            <div class="text-xs text-gray-600">Administratorzy</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-orange-500">{{ \App\Models\Role::active()->count() }}</div>
                            <div class="text-xs text-gray-600">Aktywne role</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-purple-500">{{ \App\Models\User::blocked()->count() }}</div>
                            <div class="text-xs text-gray-600">Zablokowani</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
.admin-card {
    transition: all 0.3s ease;
}

.admin-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.fade-in {
    animation: fadeIn 0.6s ease-out forwards;
    opacity: 0;
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

.fade-in:nth-child(1) { animation-delay: 0.1s; }
.fade-in:nth-child(2) { animation-delay: 0.2s; }
.fade-in:nth-child(3) { animation-delay: 0.3s; }
.fade-in:nth-child(4) { animation-delay: 0.4s; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to cards
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.classList.add('fade-in');
        card.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>
@endpush