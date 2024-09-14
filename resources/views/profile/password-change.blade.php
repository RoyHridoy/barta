<x-app-layout>
    <form action="{{ route('password-change') }}" method="post" class="mt-20 space-y-6" novalidate>
        @csrf
        @method('PUT')
        <div>
            <div class="flex items-center justify-between">
                <label for="currentPassword" class="block text-sm font-medium leading-6 text-gray-900">Current Password</label>
            </div>
            <div class="mt-2">
                <input id="currentPassword" name="currentPassword" type="password" autocomplete="current-password"
                    placeholder="••••••••" required
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
            @error('currentPassword')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
            </div>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="new-password"
                    placeholder="••••••••" required
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
            @error('password')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Retype New Password</label>
            </div>
            <div class="mt-2">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password"
                    placeholder="••••••••" required
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
            @error('password_confirmation')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                Change Password
            </button>
        </div>
    </form>
</x-app-layout>