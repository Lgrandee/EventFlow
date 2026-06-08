<x-layouts::auth simple :title="'Login'">
    <div class="space-y-6">
        <div class="text-center">
            <h1 class="text-2xl font-bold">Sign in to your account</h1>
        </div>

        <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <flux:field>
                <flux:label for="email">Email Address</flux:label>
                <flux:input 
                    id="email"
                    name="email" 
                    type="email" 
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    required
                />
                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label for="password">Password</flux:label>
                <flux:input 
                    id="password"
                    name="password" 
                    type="password" 
                    placeholder="••••••••"
                    required
                />
                <flux:error name="password" />
            </flux:field>

            <flux:field>
                <div class="flex items-center">
                    <flux:checkbox id="remember" name="remember" />
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
            </flux:field>

            <flux:button type="submit" class="w-full">Sign in</flux:button>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign up
                </a>
            </p>
        </div>
    </div>
</x-layouts::auth>

