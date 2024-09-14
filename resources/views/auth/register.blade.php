<x-guest-layout>
    <x-slot:heading>
        Create a new account
    </x-slot:heading>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('register') }}" method="POST" novalidate>
            @csrf
            <!-- First Name -->
            <x-input name="firstName" placeholder="Alp" label="First Name" value="{{ old('firstName') }}" />

            <!-- Last Name -->
            <x-input name="lastName" placeholder="Arslan" label="last Name" value="{{ old('lastName') }}" />

            <!-- Username -->
            <x-input name="username" placeholder="alparslan1029" label="Username" value="{{ old('username') }}" />

            <!-- Email -->
            <x-input name="email" type="email" placeholder="alp.arslan@mail.com" label="Email address" value="{{ old('email') }}" />

            <!-- Password -->
            <x-input name="password" type="password" placeholder="••••••••" label="Password" />

            <div>
                <x-button type="submit">Sign Up</x-button>
            </div>
        </form>

        <p class="mt-10 text-sm text-center text-gray-500">
            Already a member?
            <a href="{{ route('login') }}" class="font-semibold leading-6 text-black hover:text-black">Sign In</a>
        </p>
    </div>
</x-guest-layout>