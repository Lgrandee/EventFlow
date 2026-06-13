<x-layouts::layouts>

    @section('content')

        <div class="content-center flex flex-col items-center mt-10">

            @foreach ($events as $event)

                @php
                    $registered = $event->registrations->count();
                    $max = (int) $event->max_attendees;
                @endphp

                <div class="w-7/12 mb-6 p-6 border rounded-lg shadow-sm flex flex-col gap-3">

                    <h2 class="text-2xl font-bold">
                        {{ $event->name }}
                    </h2>

                    <p class="text-gray-600">
                        {{ $event->description }}
                    </p>

                    <p>
                        <strong>Start Time:</strong>
                        {{ $event->start_time }}
                    </p>

                    <p>
                        <strong>Location:</strong>
                        {{ $event->location }}
                    </p>


                    <p>
                        <strong>Available Places:</strong>
                        {{ $registered }} / {{ $max }}
                    </p>

                    @if($max > 0)

                        @if($registered >= $max)

                            <span class="bg-red-500 text-white px-3 py-1 rounded w-fit">
                                Volgeboekt
                            </span>

                        @else

                            <span class="bg-green-500 text-white px-3 py-1 rounded w-fit">
                                Beschikbaar
                            </span>

                        @endif

                    @else

                        <span class="bg-yellow-400 text-black px-3 py-1 rounded w-fit">
                            Maximum aantal deelnemers niet ingesteld
                        </span>

                    @endif

                    <a href="{{ route('events.show', $event) }}"
                        class="bg-blue-950 text-white px-4 py-2 rounded w-fit hover:bg-blue-800">
                        View Details
                    </a>

                </div>

            @endforeach

        </div>

    @endsection

</x-layouts::layouts>