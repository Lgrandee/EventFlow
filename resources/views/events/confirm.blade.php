<x-layouts::layouts>

    @section('content')

        @php
            $registered = $event->registrations->count();
            $max = (int) $event->max_attendees;
            $available = $max - $registered;
        @endphp

        <div class="max-w-xl mx-auto mt-10 border rounded-lg p-6 shadow">

            <h1 class="text-2xl font-bold mb-4">
                Bevestig inschrijving
            </h1>

            <p class="mb-2">
                <strong>Evenement:</strong>
                {{ $event->name }}
            </p>

            <p class="mb-4">
                <strong>Beschikbare plaatsen:</strong>
                {{ $available }} / {{ $max }}
            </p>

            <p class="mb-6">
                Weet je zeker dat je je wilt aanmelden voor dit evenement?
            </p>

            <form action="{{ route('events.register', $event) }}" method="POST">
                @csrf

                <button
                    type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Ja, aanmelden
                </button>

                <a
                    href="{{ route('events.show', $event) }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded ml-2 inline-block hover:bg-gray-600">
                    Annuleren
                </a>

            </form>

        </div>

    @endsection

</x-layouts::layouts>