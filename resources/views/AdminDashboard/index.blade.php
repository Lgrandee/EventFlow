<x-layouts::layouts>
    @section('content')
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Header Sectie met Titel en Fast Access Beheerknoppen --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Admin Panel</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage and organize all your platform events and configurations.</p>
                </div>
                
                {{-- Fast Access Actie Knoppen --}}
                <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                    {{-- Snelkoppeling naar Categorieën Beheer --}}
                    <a href="{{ route('admin.categories.index') }}"
                        class="bg-white border border-gray-300 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-50 transition font-medium text-sm shadow-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.181 0l5.103-5.103a2.25 2.25 0 0 0 0-3.181l-9.582-9.584A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                        Manage Categories
                    </a>

                    {{-- Snelkoppeling naar Event Aanmaken --}}
                    <a href="{{ route('admin.events.create') }}"
                        class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium text-sm shadow-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create Event
                    </a>
                </div>
            </div>

            {{-- Succes- en Foutmeldingen --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-800 p-4 rounded-lg mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Overzichtstabel --}}
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
                                {{-- Titel & Beschrijving --}}
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900 text-base">{{ $event->title }}</div>
                                    <div class="text-gray-500 text-xs mt-0.5 line-clamp-1 max-w-xs">{{ $event->description }}</div>
                                </td>
                                {{-- Categorie --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        {{ $event->category->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                {{-- Locatie --}}
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $event->location }}
                                </td>
                                {{-- Datum --}}
                                <td class="px-6 py-4 text-gray-600 font-medium">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y H:i') }}
                                </td>
                                {{-- Tickets / Capaciteit --}}
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $event->max_tickets }} tickets
                                </td>
                                {{-- Actieknoppen (View, Edit & Delete) --}}
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Fast Access View Knop (Naar publieke pagina) --}}
                                        <a href="{{ route('events.show', $event) }}" target="_blank"
                                            class="text-gray-600 hover:text-gray-900 font-medium text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-md transition"
                                            title="Bekijk hoe bezoekers dit evenement zien">
                                            View
                                        </a>

                                        {{-- Edit Knop --}}
                                        <a href="{{ route('AdminDashboard.edit', $event) }}"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium text-xs bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-md transition">
                                            Edit
                                        </a>

                                        {{-- Delete Knop --}}
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this event permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 font-medium text-xs bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-8 h-8 mx-auto text-gray-400 mb-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                    <span class="block font-medium text-gray-700">No events found</span>
                                    <span class="text-xs text-gray-400 mt-0.5">Get started by creating your very first event.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    @endsection
</x-layouts::layouts>