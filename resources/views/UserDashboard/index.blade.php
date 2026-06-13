<x-layouts::layouts>
    <x-slot name="title">
        Dashboard
    </x-slot>

    @section('content')

        <div class="max-w-4xl mx-auto">

            <h1 class="text-3xl font-bold mb-6">
                Mijn Dashboard
            </h1>

            <div class="bg-white rounded-lg shadow p-6">

                <h2 class="text-2xl font-bold mb-4">
                    Welkom, {{ Auth::user()->name }}!
                </h2>

                <p class="text-gray-600 mb-6">
                    Hier kun je jouw evenementen beheren en bekijken.
                </p>

                <a href="{{ route('userevent') }}"
                    class="bg-blue-950 text-white px-4 py-2 rounded w-fit hover:bg-blue-800">
                    Ga naar mijn evenementen
                </a>

            </div>

        </div>

    @endsection
</x-layouts::layouts>