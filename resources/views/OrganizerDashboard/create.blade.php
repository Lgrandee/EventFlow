<x-layouts::layouts>
    @section('content')
        <div class="p-6 max-w-xl mx-auto">

            <h1 class="text-2xl font-bold mb-6">
                Create Event
            </h1>

            {{-- Foutmeldingen tonen als het opslaan mislukt --}}
            @if($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FIX 1: Route aangepast naar admin.events.store --}}
            <form action="{{ route('admin.events.store') }}" method="POST">
                @csrf

                {{-- FIX 2: Veldnaam en ID aangepast van 'name' naar 'title' --}}
                <div class="mb-4">
                    <label for="title" class="block font-bold mb-2">
                        Event Title
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required />
                </div>

                {{-- FIX 3: Jouw HTML-stijl toegepast op de nieuwe Categorieën Drop-down --}}
                <div class="mb-4">
                    <label for="category_id" class="block font-bold mb-2">
                        Category
                    </label>
                    <select id="category_id" name="category_id"
                        class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>
                        <option value="">Select a category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="location" class="block font-bold mb-2">
                        Location
                    </label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required />
                </div>

                <div class="mb-4">
                    <label for="date" class="block font-bold mb-2">
                        Date & Time
                    </label>
                    <input type="datetime-local" id="date" name="date" value="{{ old('date') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required />
                </div>

                <div class="mb-4">
                    <label for="max_tickets" class="block font-bold mb-2">
                        Maximum Tickets
                    </label>
                    <input type="number" id="max_tickets" name="max_tickets" min="1" value="{{ old('max_tickets') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required />
                </div>

                <div class="mb-6">
                    <label for="description" class="block font-bold mb-2">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="5"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.events') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                        Save Event
                    </button>
                </div>
            </form>

        </div>
    @endsection
</x-layouts::layouts>