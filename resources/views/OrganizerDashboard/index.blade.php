<x-layouts::layouts>
    @section('content')
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Organizer Dashboard</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage your events and configure categories quickly.</p>
                </div>
                
                <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('admin.categories.index') }}"
                        class="bg-white border border-gray-300 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-50 transition font-medium text-sm shadow-sm flex items-center gap-2">
                        Manage Categories
                    </a>

                    <a href="{{ route('admin.events.create') }}"
                        class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium text-sm shadow-sm flex items-center gap-2">
                        Create Event
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-800 p-4 rounded-lg mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="px-6 py-4">Event Details</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4">Date & Time</th>
                            <th class="px-6 py-4">Capacity</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        @forelse($events as $event)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900 text-base">{{ $event->title }}</div>
                                    <div class="text-gray-500 text-xs mt-0.5 line-clamp-1 max-w-xs">{{ $event->description }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        {{ $event->category->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $event->location }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 font-medium">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $event->max_tickets }} tickets
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('events.show', $event) }}" target="_blank"
                                            class="text-gray-600 hover:text-gray-900 font-medium text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-md transition">
                                            View
                                        </a>
                                        <a href="{{ route('admin.events.edit', $event) }}"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium text-xs bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-md transition">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No events found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
</x-layouts::layouts>