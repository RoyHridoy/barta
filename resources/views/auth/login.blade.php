<x-guest-layout>
    <x-slot:heading>
        Sign in to your account
    </x-slot:heading>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div>
            @session('success')
                <x-flash type="success"/>
            @endsession

        </div>
        <form class="space-y-6" action="{{ route('login') }}" method="POST" novalidate>
            @csrf
            <!-- Email -->
            <x-input name="email" type="email" placeholder="alp.arslan@mail.com" label="Email address" value="{{ old('email') }}"/>

            <!-- Password -->
            <x-input name="password" type="password" placeholder="••••••••" label="Password"/>

            <div class="flex items-center mb-4">
                <input id="rememberMe" type="checkbox" name="rememberMe" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="rememberMe" class="text-sm font-medium text-gray-900 ms-2">Remember me</label>
            </div>
            
            <div>
                <x-button type="submit">Sign In</x-button>
            </div>
        </form>

        <p class="mt-10 text-sm text-center text-gray-500">
            Don't have an account yet?
            <a href="{{ route('register') }}" class="font-semibold leading-6 text-black hover:text-black">Sign Up</a>
        </p>
    </div>
</x-guest-layout>