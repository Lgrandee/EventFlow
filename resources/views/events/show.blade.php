<x-layouts::layouts>
    <x-slot name="title">
        {{ $event->name }}
    </x-slot>
    @section('content')
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold mb-4">{{ $event->name }}</h1>
            <p class="text-gray-600 mb-6">{{ $event->description }}</p>
            <p class="text-lg font-semibold">Date: {{ $event->start_time }}</p>
            <p class="text-lg font-semibold">Category: {{ $event->category?->name ?? 'Uncategorized' }}</p>
            <p class="text-lg font-semibold">Max Attendees: {{ $event->max_attendees }}</p>
            <p class="text-lg font-semibold">Created by: {{ $event->creator?->name ?? 'Unknown' }}</p>
            <a href="{{ route('events.index') }}" class="bg-blue-950 text-white border rounded-lg p-2 mt-4 inline-block">Sign in</a>
            <a href="{{ route('events.index') }}" class="bg-blue-950 text-white border rounded-lg p-2 mt-4 inline-block">Back to Events</a>




        </div>


    @endsection
</x-layouts::layouts>