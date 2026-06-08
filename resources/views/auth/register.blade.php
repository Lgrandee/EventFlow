<x-layouts::auth simple :title="'Register'">
    <div class="space-y-6">
        <div class="text-center">
            <h1 class="text-2xl font-bold">Create your account</h1>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <flux:field>
                <flux:label for="name">Full Name</flux:label>
                <flux:input 
                    id="name"
                    name="name" 
                    type="text" 
                    placeholder="John Doe"
                    value="{{ old('name') }}"
                    required
                />
                <flux:error name="name" />
            </flux:field>

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
                <flux:label for="password_confirmation">Confirm Password</flux:label>
                <flux:input 
                    id="password_confirmation"
                    name="password_confirmation" 
                    type="password" 
                    placeholder="••••••••"
                    required
                />
                <flux:error name="password_confirmation" />
            </flux:field>

            <flux:button type="submit" class="w-full">Sign up</flux:button>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</x-layouts::auth>

