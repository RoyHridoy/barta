<x-guest-layout>
    <x-slot:heading>
        Create a new account
    </x-slot:heading>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('register') }}" method="POST" novalidate>
            @csrf
            <!-- First Name -->
            <div>
                <label for="firstName" class="block text-sm font-medium leading-6 text-gray-900">First Name</label>
                <div class="mt-2">
                    <input id="firstName" name="firstName" type="text" autocomplete="firstName" placeholder="Alp" required value="{{ old('firstName') }}"
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('firstName') ring-red-300 @else ring-gray-300 @enderror" />
                </div>
                @error('firstName')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="lastName" class="block text-sm font-medium leading-6 text-gray-900">Last Name</label>
                <div class="mt-2">
                    <input id="lastName" name="lastName" type="text" autocomplete="lastName" placeholder="Arslan" required value="{{ old('lastName') }}"
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('lastName') ring-red-300 @else ring-gray-300 @enderror" />
                </div>
                @error('lastName')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="mt-2">
                    <input id="username" name="username" type="text" autocomplete="username" placeholder="alparslan1029"
                        required value="{{ old('username') }}"
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('firstName') ring-red-300 @else ring-gray-300  @enderror" />
                </div>
                @error('username')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" placeholder="alp.arslan@mail.com"
                        required value="{{ old('email') }}"
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('firstName') ring-red-300 @else ring-gray-300 @enderror" />
                </div>
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password"
                        placeholder="••••••••" required
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('firstName') ring-red-300 @else ring-gray-300 @enderror" />
                </div>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                    Register
                </button>
            </div>
        </form>

        <p class="mt-10 text-sm text-center text-gray-500">
            Already a member?
            <a href="{{ route('login') }}" class="font-semibold leading-6 text-black hover:text-black">Sign In</a>
        </p>
    </div>


</x-guest-layout>