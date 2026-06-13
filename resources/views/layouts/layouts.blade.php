<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EventFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div>
                    <a href="/" class="text-2xl font-bold text-indigo-600">
                        EventFlow
                    </a>
                </div>

                {{-- DYNAMISCHE NAVIGATIE GEBASEERD OP ROLLEN --}}
                <div class="flex items-center gap-6">

                    {{-- 1. ZICHTBAAR VOOR GASTEN (NIET INGELOGD) --}}
                    @guest
                        <a href="{{ route('login') }}"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                            Inloggen
                        </a>
                    @endguest

                    {{-- 2. ZICHTBAAR VOOR INGELOGDE GEBRUIKERS --}}
                    @auth
                        {{-- A. KNOPPEN SPECIFIEK VOOR DE ADMIN --}}
                        @if(auth()->user()->role === 'Admin')
                            <a href="{{ route('admin.events') }}"
                                class="text-red-700 hover:text-red-900 font-semibold border-r pr-4 border-gray-300 text-sm transition">
                                Admin Paneel
                            </a>
                            <a href="{{ route('admin.categories.index') }}"
                                class="text-gray-700 hover:text-indigo-600 font-medium text-sm border-r pr-4 border-gray-300 transition">
                                Categorieën
                            </a>
                        @endif

                        {{-- B. KNOPPEN SPECIFIEK VOOR DE ORGANISATOR --}}
                        @if(auth()->user()->role === 'Organizer')
                            <a href="{{ route('admin.events') }}"
                                class="text-blue-900 hover:text-blue-700 font-semibold border-r pr-4 border-gray-300 text-sm transition">
                                Organisator Overzicht
                            </a>
                            <a href="{{ route('admin.categories.index') }}"
                                class="text-gray-700 hover:text-indigo-600 font-medium text-sm border-r pr-4 border-gray-300 transition">
                                Categorieën Beheer
                            </a>
                            <a href="{{ route('admin.events.create') }}"
                                class="text-green-700 hover:text-green-600 font-semibold border-r pr-4 border-gray-300 text-sm transition">
                                + Nieuw Event
                            </a>
                        @endif

                        {{-- C. ALTIJD ZICHTBAAR VOOR ELKE INLOGDE USER --}}
                        <a href="{{ route('userevent') }}"
                            class="text-indigo-600 hover:text-indigo-800 font-medium border-r pr-4 border-gray-300 text-sm transition">
                            Mijn Dashboard
                        </a>

                        <span class="text-gray-700 font-medium text-sm">
                            Welkom, {{ auth()->user()->name }}
                            <span class="text-xs text-gray-400 font-normal">({{ auth()->user()->role }})</span>
                        </span>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                Uitloggen
                            </button>
                        </form>
                    @endauth

                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-8">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <div class="grid md:grid-cols-3 gap-8">

                <div>
                    <h3 class="text-xl font-bold mb-3">EventFlow</h3>
                    <p class="text-gray-400">
                        Het platform voor het beheren en organiseren van evenementen.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-3">Links</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/" class="hover:text-white transition">Home</a></li>
                        <li><a href="/events" class="hover:text-white transition">Events</a></li>
                        <li><a href="/about" class="hover:text-white transition">Over ons</a></li>
                        <li><a href="/contact" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-3">Contact</h3>
                    <p class="text-gray-400">info@eventflow.nl</p>
                    <p class="text-gray-400">+31 6 12345678</p>
                </div>

            </div>

            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-500">
                &copy; {{ date('Y') }} EventFlow. Alle rechten voorbehouden.
            </div>
        </div>
    </footer>
</body>

</html>