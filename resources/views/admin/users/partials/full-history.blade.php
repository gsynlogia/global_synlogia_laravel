<div id="full-history-content" class="max-w-4xl">
    @if($user->notes->count() > 0)
        <!-- Filters -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700">Sortowanie:</label>
                    <select id="sort-order" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#124f9e] focus:border-transparent">
                        <option value="desc">Najnowsze najpierw</option>
                        <option value="asc">Najstarsze najpierw</option>
                    </select>
                </div>
                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700">Filtruj typ:</label>
                    <select id="filter-type" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#124f9e] focus:border-transparent">
                        <option value="all">Wszystkie</option>
                        <option value="system">System</option>
                        <option value="login">Logowanie</option>
                        <option value="block">Blokada</option>
                        <option value="unblock">Odblokowanie</option>
                        <option value="permission_change">Zmiany uprawnień</option>
                        <option value="manual">Notatki ręczne</option>
                    </select>
                </div>
                <div class="text-sm text-gray-500">
                    Łącznie: <span id="total-count">{{ $user->notes->count() }}</span> wpisów
                </div>
            </div>
        </div>

        <!-- History entries -->
        <div id="history-entries" class="space-y-4 max-h-96 overflow-y-auto pr-2">
            @foreach($user->notes->sortByDesc('created_at') as $note)
                <div class="history-entry border-l-4 {{ $note->type === 'block' ? 'border-red-400' : ($note->type === 'unblock' ? 'border-green-400' : ($note->type === 'manual' ? 'border-purple-400' : 'border-blue-400')) }} bg-gray-50 p-4 rounded-r-lg"
                     data-type="{{ $note->type }}"
                     data-timestamp="{{ $note->created_at->timestamp }}"
                     data-date="{{ $note->created_at->toISOString() }}">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $note->type_color }}">
                                {!! $note->type_icon !!}
                                <span class="ml-1">{{ $note->type_name }}</span>
                            </span>
                            <span class="text-xs text-gray-500">{{ $note->created_at->format('d.m.Y H:i:s') }}</span>
                        </div>
                    </div>
                    <h4 class="font-medium text-gray-900 mb-2">{{ $note->title }}</h4>
                    <div class="text-sm text-gray-600 mb-3 whitespace-pre-wrap">{{ $note->content }}</div>

                    @if($note->metadata && count($note->metadata) > 0)
                        <div class="bg-white rounded p-3 mb-2">
                            <h5 class="text-xs font-medium text-gray-700 mb-2">Dodatkowe informacje:</h5>
                            <div class="space-y-1">
                                @foreach($note->metadata as $key => $value)
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500 capitalize">
                                            @switch($key)
                                                @case('ip')
                                                    Adres IP:
                                                    @break
                                                @case('user_agent')
                                                    Przeglądarka:
                                                    @break
                                                @case('previous_status')
                                                    Poprzedni status:
                                                    @break
                                                @case('new_status')
                                                    Nowy status:
                                                    @break
                                                @default
                                                    {{ ucfirst(str_replace('_', ' ', $key)) }}:
                                            @endswitch
                                        </span>
                                        <span class="text-gray-900 text-right max-w-xs truncate" title="{{ $value }}">
                                            @if($key === 'previous_status' || $key === 'new_status')
                                                @if($value === 'active')
                                                    <span class="text-green-600">Aktywny</span>
                                                @elseif($value === 'blocked')
                                                    <span class="text-red-600">Zablokowany</span>
                                                @else
                                                    {{ $value }}
                                                @endif
                                            @else
                                                {{ $value }}
                                            @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($note->createdBy)
                        <div class="flex items-center space-x-2 text-xs text-gray-500">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            <span>Utworzone przez: {{ $note->createdBy->name }}</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Brak historii</h3>
            <p class="mt-1 text-sm text-gray-500">Ten użytkownik nie ma jeszcze żadnych notatek w historii.</p>
        </div>
    @endif
</div>