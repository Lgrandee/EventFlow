<x-layouts::Layouts>
    @section('content')
        <div class="p-6 max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Categorieën Beheer</h1>
                <flux:button href="{{ route('admin.categories.create') }}" variant="filled" color="primary">
                    Nieuwe Categorie
                </flux:button>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4">{{ session('error') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 font-semibold">Naam</th>
                            <th class="p-4 font-semibold">Aantal Evenementen</th>
                            <th class="p-4 font-semibold text-right">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($categories as $category)
                            <tr>
                                <td class="p-4">{{ $category->name }}</td>
                                <td class="p-4">{{ $category->events_count }}</td>
                                <td class="p-4 text-right">
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                        onsubmit="return confirm('Weet je zeker dat je deze categorie wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" variant="ghost" color="danger">Verwijderen</flux:button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
</x-layouts::Layouts>