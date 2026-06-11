<x-layouts::layouts>
    @section('content')
        <div class=" content-center flex flex-col items-center mt-10">
            <div class="text-left mb-6 p-4 border rounded-lg shadow-sm w-7/12 place-content-between gap-3 flex flex-col">
              <form action="{{ route('events.create') }}" method="POST">
                @csrf
                <div class="mb-4">
                  <label for="name" class="block text-gray-700 font-bold mb-2">Event Name</label>
                  <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                  <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                  <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="mb-4">
                  <label for="start_time" class="block text-gray-700 font-bold mb-2">Start Time</label>
                  <input type="datetime-local" id="start_time" name="start_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                  <label for="location" class="block text-gray-700 font-bold mb-2">Location</label>
                  <input type="text" id="location" name="location" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                  <label for="max_attendees" class="block text-gray-700 font-bold mb-2">Max Attendees</label>
                  <input type="number" id="max_attendees" name="max_attendees" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <button type="submit" class="bg-blue-950 text-white border rounded-lg p-2">Create Event</button>
              </form>
            </div>
        </div>
    @endsection
</x-layouts::layouts> 