<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-6">
            Welcome Back
        </h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
            >
                Sign In
            </button>
        </form>

        @if ($errors->any())
            <div class="mt-4 text-red-500">
                {{ $errors->first() }}
            </div>
        @endif
    </div>

</body>
</html>