<x-layouts::layouts>
    @section('content')
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Mijn Inschrijvingen</h1>
            
            @if($events->isEmpty())
                <div class="bg-white p-8 rounded-lg border border-gray-200 text-center">
                    <p class="text-gray-500">Je bent nog niet ingeschreven voor evenementen.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
                            <h2 class="text-xl font-bold text-gray-900">{{ $event->name }}</h2>
                            <p class="text-gray-600 mt-2 text-sm">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                            <div class="mt-4">
                                <a href="{{ route('events.show', $event) }}" class="text-indigo-600 font-medium hover:text-indigo-800">Bekijk Details &rarr;</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endsection
</x-layouts::layouts>