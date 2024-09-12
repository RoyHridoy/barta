<x-guest-layout>
    <x-slot:heading>
        Sign in to your account
    </x-slot:heading>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div>
            @session('success')
                <div class="p-2 font-bold text-center text-teal-900 bg-teal-300 rounded">
                    {{ session('success') }}
                </div>
            @endsession

        </div>
        <form class="space-y-6" action="{{ route('login') }}" method="POST" novalidate>
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" placeholder="bruce@wayne.com" value="{{ old('email') }}"
                        required
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password"
                        placeholder="••••••••" required
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                    Sign in
                </button>
            </div>
        </form>

        <p class="mt-10 text-sm text-center text-gray-500">
            Don't have an account yet?
            <a href="{{ route('register') }}" class="font-semibold leading-6 text-black hover:text-black">Sign Up</a>
        </p>
    </div>

</x-guest-layout>