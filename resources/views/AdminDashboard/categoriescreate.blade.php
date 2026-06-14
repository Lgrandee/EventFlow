<x-layouts::layouts>
    @section('content')
    <div class="p-6 max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-6">Nieuwe Categorie Toevoegen</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <flux:field>
                <flux:label for="name">Naam Categorie</flux:label>
                <flux:input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Bijv. Workshops, Concerten..." required />
                <flux:error name="name" />
            </flux:field>

            <div class="flex space-x-2 justify-end">
                <flux:button href="{{ route('admin.categories.index') }}" variant="ghost">Annuleren</flux:button>
                <flux:button type="submit" variant="filled" color="primary">Opslaan</flux:button>
            </div>
        </form>
    </div>
    @endsection
</x-layouts::layouts>