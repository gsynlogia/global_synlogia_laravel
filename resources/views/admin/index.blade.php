@extends('layouts.admin')

@section('title', 'Panel Administracyjny - Global Synlogia')
@section('page-title', 'Dashboard')
@section('page-description', 'Przegląd systemu i statystyki')

@section('content')
<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Wszyscy użytkownicy</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::count() }}</p>
                <div class="flex items-center mt-2">
                    <span class="text-green-600 text-sm font-medium">
                        +{{ \App\Models\User::where('created_at', '>=', now()->subDays(30))->count() }}
                    </span>
                    <span class="text-gray-500 text-xs ml-1">w tym miesiącu</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Active Users -->
    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Aktywni użytkownicy</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::active()->count() }}</p>
                <div class="flex items-center mt-2">
                    <span class="text-green-600 text-sm font-medium">
                        {{ round((\App\Models\User::active()->count() / max(\App\Models\User::count(), 1)) * 100, 1) }}%
                    </span>
                    <span class="text-gray-500 text-xs ml-1">wszystkich</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Roles -->
    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Role systemowe</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Role::count() }}</p>
                <div class="flex items-center mt-2">
                    <span class="text-blue-600 text-sm font-medium">
                        {{ \App\Models\Role::active()->count() }}
                    </span>
                    <span class="text-gray-500 text-xs ml-1">aktywnych</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Permissions -->
    <div class="stat-card p-6 rounded-xl border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Uprawnienia</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Permission::count() }}</p>
                <div class="flex items-center mt-2">
                    <span class="text-orange-600 text-sm font-medium">
                        {{ \App\Models\Permission::distinct('group')->count('group') }}
                    </span>
                    <span class="text-gray-500 text-xs ml-1">grup</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Management Cards -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Zarządzanie systemem</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Users -->
                <a href="{{ route('admin.users.index') }}" class="group p-4 rounded-lg border border-gray-200 hover:border-[#124f9e] transition-all duration-300 card-hover">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-[#124f9e]/10 rounded-lg flex items-center justify-center group-hover:bg-[#124f9e]/20 transition-colors">
                            <svg class="w-5 h-5 text-[#124f9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-[#124f9e] group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Użytkownicy</h4>
                    <p class="text-sm text-gray-600">Zarządzaj kontami użytkowników, blokuj i przypisuj role</p>
                </a>

                <!-- Roles -->
                <a href="{{ route('admin.roles.index') }}" class="group p-4 rounded-lg border border-gray-200 hover:border-[#de244b] transition-all duration-300 card-hover">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-[#de244b]/10 rounded-lg flex items-center justify-center group-hover:bg-[#de244b]/20 transition-colors">
                            <svg class="w-5 h-5 text-[#de244b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-[#de244b] group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Role</h4>
                    <p class="text-sm text-gray-600">Twórz i edytuj role, przypisuj uprawnienia</p>
                </a>

                <!-- Permissions -->
                <a href="{{ route('admin.permissions.index') }}" class="group p-4 rounded-lg border border-gray-200 hover:border-green-500 transition-all duration-300 card-hover">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-green-500/10 rounded-lg flex items-center justify-center group-hover:bg-green-500/20 transition-colors">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-green-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Uprawnienia</h4>
                    <p class="text-sm text-gray-600">Konfiguruj uprawnienia systemowe</p>
                </a>

                <!-- Trash -->
                <a href="{{ route('admin.users.trash') }}" class="group p-4 rounded-lg border border-gray-200 hover:border-purple-500 transition-all duration-300 card-hover">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-purple-500/10 rounded-lg flex items-center justify-center group-hover:bg-purple-500/20 transition-colors">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-purple-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Kosz</h4>
                    <p class="text-sm text-gray-600">Przywracaj usunięte elementy</p>
                </a>
            </div>
        </div>
    </div>

    <!-- System Status -->
    <div>
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Status systemu</h3>

            <!-- System Health -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Status ACL</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Aktywny
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Użytkownicy zablokowany</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ \App\Models\User::blocked()->count() > 0 ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ \App\Models\User::blocked()->count() }}
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Elementy w koszu</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ \App\Models\User::onlyTrashed()->count() > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ \App\Models\User::onlyTrashed()->count() }}
                    </span>
                </div>

                @if(auth()->user()->isSuperuser())
                <div class="pt-4 border-t border-gray-100">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium text-red-600">Super Administrator</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Pełne uprawnienia systemowe</p>
                </div>
                @elseif(auth()->user()->isAdmin())
                <div class="pt-4 border-t border-gray-100">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium text-blue-600">Administrator</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Uprawnienia administracyjne</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-white rounded-xl border border-gray-100 p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">Ostatnia aktywność</h3>
        <a href="{{ route('admin.users.index') }}" class="text-sm text-[#124f9e] hover:text-[#0f3f85] font-medium">
            Zobacz wszystko →
        </a>
    </div>

    <div class="space-y-4">
        @foreach(\App\Models\User::latest()->limit(5)->get() as $user)
        <div class="flex items-center space-x-4">
            <div class="w-10 h-10 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                <p class="text-xs text-gray-500">{{ $user->email }} • {{ $user->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex items-center space-x-2">
                @if($user->isSuperuser())
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Superuser
                    </span>
                @elseif($user->isAdmin())
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Admin
                    </span>
                @else
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        User
                    </span>
                @endif

                @if($user->isBlocked())
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Blocked
                    </span>
                @endif
            </div>
        </div>
        @endforeach

        @if(\App\Models\User::count() === 0)
        <div class="text-center py-8 text-gray-500">
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
            </svg>
            <p class="text-sm">Brak użytkowników w systemie</p>
        </div>
        @endif
    </div>
</div>
@endsection