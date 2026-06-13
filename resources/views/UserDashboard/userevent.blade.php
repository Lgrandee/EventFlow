<x-layouts::layouts>
    @section('content')

        <div class="max-w-4xl mx-auto">

            <h1 class="text-3xl font-bold mb-6">
                Mijn Evenementen
            </h1>

            @foreach($events as $event)

                @php
                    $registered = $event->registrations->count();
                    $max = $event->max_attendees;
                @endphp

                <div class="bg-white rounded-lg shadow p-6 mb-6">

                    <h2 class="text-2xl font-bold mb-2">
                        {{ $event->name }}
                    </h2>

                    <p class="text-gray-600 mb-4">
                        {{ $event->description }}
                    </p>

                    <p>
                        <strong>Date:</strong>
                        {{ $event->start_time }}
                    </p>

                    <p>
                        <strong>Location:</strong>
                        {{ $event->location }}
                    </p>

                    <p>
                        <strong>Category:</strong>
                        {{ $event->category?->name ?? 'Uncategorized' }}
                    </p>

                    <p>
                        <strong>Available Places:</strong>
                        {{ max(0, $max - $registered) }}
                    </p>

                </div>

            @endforeach

        </div>
</x-layouts::layouts>