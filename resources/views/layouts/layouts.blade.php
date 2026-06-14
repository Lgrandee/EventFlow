<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EventFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    {{-- Navigatiebalk --}}
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <div class="shrink-0">
                    <a href="/" class="text-2xl font-bold text-indigo-600">EventFlow</a>
                </div>

                {{-- Navigatie Links --}}
                <div class="flex items-center gap-6">
                    @guest
                        <a href="{{ route('login') }}"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium text-sm">
                            Inloggen
                        </a>
                    @endguest

                    @auth
                        {{-- Admin Links --}}
                        @if(auth()->user()->role === 'Admin')
                            <a href="{{ route('admin.events') }}"
                                class="text-red-700 hover:text-red-900 font-semibold border-r pr-4 border-gray-300 text-sm transition">Admin
                                Paneel</a>
                            <a href="{{ route('admin.categories.index') }}"
                                class="text-gray-700 hover:text-indigo-600 font-medium text-sm border-r pr-4 border-gray-300 transition">Categorieën</a>
                        @endif

                        {{-- Organizer Links --}}
                        @if(auth()->user()->role === 'Organizer')
                            <a href="{{ route('organizer.dashboard') }}"
                                class="text-blue-900 hover:text-blue-700 font-semibold border-r pr-4 border-gray-300 text-sm transition">Mijn
                                Dashboard</a>
                            <a href="{{ route('admin.categories.index') }}"
                                class="text-gray-700 hover:text-indigo-600 font-medium text-sm border-r pr-4 border-gray-300 transition">Categorieën</a>
                            <a href="{{ route('admin.events.create') }}"
                                class="text-green-700 hover:text-green-600 font-semibold border-r pr-4 border-gray-300 text-sm transition">+
                                Nieuw Event</a>
                        @endif

                        {{-- Algemeen --}}
                        <a href="{{ route('userevent') }}"
                            class="text-indigo-600 hover:text-indigo-800 font-medium border-r pr-4 border-gray-300 text-sm transition">Mijn
                            Profiel</a>

                        {{-- Uitloggen (POST methode voor veiligheid) --}}
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold cursor-pointer">
                                Uitloggen
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hoofdinhoud --}}
    <main class="grow pt-8 max-w-7xl mx-auto w-full px-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white mt-16 py-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-3">EventFlow</h3>
                    <p class="text-gray-400">Het platform voor het beheren en organiseren van evenementen.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Links</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/" class="hover:text-white transition">Home</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Contact</h3>
                    <p class="text-gray-400">info@eventflow.nl</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-500">
                &copy; {{ date('Y') }} EventFlow. Alle rechten voorbehouden.
            </div>
        </div>
    </footer>
</body>

</html>