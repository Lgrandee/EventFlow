<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div>
                    <a href="/" class="text-2xl font-bold text-indigo-600">
                        EventFlow
                    </a>
                </div>

                <!-- <div class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-700 hover:text-indigo-600 transition">
                    Home
                </a>
                <a href="/events" class="text-gray-700 hover:text-indigo-600 transition">
                    Events
                </a>
                <a href="/about" class="text-gray-700 hover:text-indigo-600 transition">
                    Over ons
                </a>
                <a href="/contact" class="text-gray-700 hover:text-indigo-600 transition">
                    Contact
                </a>
            </div> -->

                <div>
                    @guest
                        <a href="{{ route('login') }}"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                            Inloggen
                        </a>
                    @endguest

                    @if(optional(auth()->user())->role === 'Admin')
                        <a href="{{ route('AdminDashboard') }}">Admin Dashboard</a>
                        <a href="{{ route('EventAdminController') }}">Event Dashboard</a>
                        <a href="{{ route('events.create') }}">CreateEvent</a>

                    @endif
                    @auth
                        <span class="text-gray-700 font-medium">
                            Welkom, {{ Auth::user()->name }}
                        </span>


                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                Uitloggen
                            </button>
                        </form>
                    @endauth


                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    
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
                        <li><a href="/" class="hover:text-white">Home</a></li>
                        <li><a href="/events" class="hover:text-white">Events</a></li>
                        <li><a href="/about" class="hover:text-white">Over ons</a></li>
                        <li><a href="/contact" class="hover:text-white">Contact</a></li>
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