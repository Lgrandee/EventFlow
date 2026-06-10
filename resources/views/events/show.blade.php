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
            <form action="{{ route('events.register', $event->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-950 text-white border rounded-lg p-2 mt-4">Register</button>
            </form>
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{ route('events.index') }}"
                class="bg-blue-950 text-white border rounded-lg p-2 mt-4 inline-block">Back to Events</a>
        </div>


    @endsection
</x-layouts::layouts>