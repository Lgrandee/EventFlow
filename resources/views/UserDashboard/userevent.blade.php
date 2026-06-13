<x-layouts::layouts>
    @section('content')

        <div class="max-w-4xl mx-auto">

            <h1 class="text-3xl font-bold mb-6">
                Mijn Evenementen
            </h1>

            {{-- Status- en Flashmeldingen --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- CRITERIUM: Als de deelnemer nog GEEN evenementen heeft (beide lijsten leeg) --}}
            @if($upcomingEvents->isEmpty() && $pastEvents->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    <p class="mb-4">Je bent op dit moment voor geen enkel evenement ingeschreven.</p>
                    <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold underline">
                        Bekijk alle evenementen om je aan te melden &rarr;
                    </a>
                </div>
            @else

                {{-- CRITERIUM: AANKOMENDE EVENEMENTEN --}}
                <div class="mb-10">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 border-b pb-2">
                        Aankomende evenementen ({{ $upcomingEvents->count() }})
                    </h2>

                    @if($upcomingEvents->isEmpty())
                        <p class="text-gray-500 italic">Je hebt geen aankomende evenementen.</p>
                    @else
                        @foreach($upcomingEvents as $event)
                            @php
                                $registered = $event->registrations ? $event->registrations->count() : 0;
                                $max = $event->max_attendees;
                            @endphp

                            <div class="bg-white rounded-lg shadow p-6 mb-4 flex flex-col md:flex-row md:justify-between md:items-center gap-4 border-l-4 border-indigo-500">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold mb-1 text-blue-950">
                                        {{ $event->name }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($event->description, 150) }}</p>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-gray-700">
                                        <p><strong>Datum & Tijd:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('d-m-Y H:i') }}</p>
                                        <p><strong>Locatie:</strong> {{ $event->location }}</p>
                                        <p><strong>Categorie:</strong> <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">{{ $event->category?->name ?? 'Geen' }}</span></p>
                                        <p><strong>Plekken over:</strong> {{ max(0, $max - $registered) }} van de {{ $max }}</p>
                                    </div>
                                </div>

                                {{-- CRITERIUM: Deelnemer kan zich ALLEEN afmelden voor AANKOMENDE evenementen --}}
                                <div class="flex items-center justify-start md:justify-end">
                                    <form action="{{ route('events.unregister', $event) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je je wilt uitschrijven voor dit evenement?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition duration-200 text-sm shadow-sm">
                                            Uitschrijven
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>


                {{-- CRITERIUM: AFGELOPEN EVENEMENTEN --}}
                <div>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-500 border-b pb-2">
                        Afgelopen evenementen ({{ $pastEvents->count() }})
                    </h2>

                    @if($pastEvents->isEmpty())
                        <p class="text-gray-500 italic">Je hebt nog geen evenementen bijgewoond.</p>
                    @else
                        @foreach($pastEvents as $event)
                            <div class="bg-gray-50 rounded-lg shadow-sm p-6 mb-4 flex flex-col md:flex-row md:justify-between md:items-center gap-4 border-l-4 border-gray-400 opacity-75">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold mb-1 text-gray-700 line-through">
                                        {{ $event->name }}
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-gray-500 mt-2">
                                        <p><strong>Datum & Tijd:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('d-m-Y H:i') }}</p>
                                        <p><strong>Locatie:</strong> {{ $event->location }}</p>
                                    </div>
                                </div>
                                {{-- Geen afmeldknop aanwezig bij afgelopen evenementen! --}}
                                <div class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                    Afgelopen
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            @endif

        </div>

    @endsection
</x-layouts::layouts>