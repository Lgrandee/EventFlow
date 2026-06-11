<x-layouts::layouts>
    @section('content')
        <div class=" content-center flex flex-col items-center mt-10">
            <div class="text-left mb-6 p-4 border rounded-lg shadow-sm w-7/12 place-content-between gap-3 flex flex-col">
                <h2 class=" text-black">{{ $event->name }}</h2>
                <p class="text-gray-600">{{ $event->description }}</p>
                <a href="{{ route('events.show', $event) }}" class="bg-blue-950 text-white border rounded-lg p-2 w-27">View
                    Details</a>

                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Verwijderen</button>
                </form>
            </div>
        </div>
    @endsection
</x-layouts::layouts>