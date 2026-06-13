<x-layouts::layouts>

    <x-slot name="title">
        {{ $event->name }}
    </x-slot>

    @section('content')

        @php
            $registered = $event->registrations->count();
            $available = max(0, $event->max_attendees - $registered);
        @endphp

        <div class="max-w-4xl mx-auto">

            <h1 class="text-3xl font-bold mb-4">
                {{ $event->name }}
            </h1>

            <p class="text-gray-600 mb-6">
                {{ $event->description }}
            </p>

            <div class="space-y-2 mb-6">

                <p class="text-lg">
                    <strong>Date:</strong>
                    {{ $event->start_time }}
                </p>

                <p class="text-lg">
                    <strong>Location:</strong>
                    {{ $event->location }}
                </p>

                <p class="text-lg">
                    <strong>Category:</strong>
                    {{ $event->category?->name ?? 'Uncategorized' }}
                </p>

                <p class="text-lg">
                    <strong>Available Places:</strong>
                    {{ $available }}
                </p>

            </div>

            {{-- Flash messages --}}
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Registration logic --}}
            @if($event->max_attendees === null)
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                    Maximum aantal deelnemers is niet ingesteld.
                </div>

            @elseif($registered >= $event->max_attendees)
                <button disabled class="bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed">
                    Volgeboekt
                </button>

            @else
                <a
                    href="{{ route('events.confirm', $event) }}"
                    class="bg-blue-950 text-white px-4 py-2 rounded hover:bg-blue-800">
                    Aanmelden
                </a>
            @endif

            <a href="{{ route('events.index') }}"
               class="inline-block mt-6 bg-blue-950 text-white px-4 py-2 rounded hover:bg-blue-800">
                Back to Events
            </a>

        </div>

    @endsection

</x-layouts::layouts>