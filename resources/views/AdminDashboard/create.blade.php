<x-layouts::layouts>

    @section('content')

        <div class="content-center flex flex-col items-center mt-10">

            <div class="w-7/12 p-6 border rounded-lg shadow-sm">

                <h1 class="text-2xl font-bold mb-6">
                    Create Event
                </h1>

                <form action="{{ route('events.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block font-bold mb-2">
                            Event Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="w-full border rounded px-3 py-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-bold mb-2">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="w-full border rounded px-3 py-2"
                            required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block font-bold mb-2">
                            Category
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="w-full border rounded px-3 py-2"
                            required>

                            <option value="">-- Select a category --</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="start_time" class="block font-bold mb-2">
                            Start Time
                        </label>

                        <input
                            type="datetime-local"
                            id="start_time"
                            name="start_time"
                            class="w-full border rounded px-3 py-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block font-bold mb-2">
                            Location
                        </label>

                        <input
                            type="text"
                            id="location"
                            name="location"
                            class="w-full border rounded px-3 py-2"
                            required>
                    </div>

                    <div class="mb-6">
                        <label for="max_attendees" class="block font-bold mb-2">
                            Max Attendees
                        </label>

                        <input
                            type="number"
                            id="max_attendees"
                            name="max_attendees"
                            min="1"
                            class="w-full border rounded px-3 py-2"
                            required>
                    </div>

                    <button
                        type="submit"
                        class="bg-blue-950 text-white px-5 py-2 rounded hover:bg-blue-800">
                        Create Event
                    </button>

                </form>

            </div>

        </div>

    @endsection

</x-layouts::layouts>