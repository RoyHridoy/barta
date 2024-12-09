<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav
    x-data="{ mobileMenuOpen: false, userMenuOpen: false }"
    class="fixed z-40 w-full bg-white shadow mb-9"
>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 gap-x-2 sm:gap-x-8">
            <div class="flex">
                <div class="flex items-center flex-shrink-0">
                    <a
                        href="/"
                        wire:navigate
                    >
                        <h2 class="text-2xl font-bold">Barta</h2>
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">

                </div>
            </div>
            <div class="flex items-center">
                <livewire:search />
            </div>
            <div class="hidden gap-2 sm:ml-6 sm:flex sm:items-center">
                <!-- Profile dropdown -->
                <div
                    class="relative ml-3"
                    x-data="{ open: false }"
                >
                    <div>
                        <button
                            id="user-menu-button"
                            type="button"
                            class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            aria-expanded="false"
                            aria-haspopup="true"
                            @click="open = !open"
                        >
                            <span class="sr-only">Open user menu</span>
                            <img
                                class="w-8 h-8 rounded-full"
                                src="{{ auth()->user()->avatar }}"
                                alt="{{ auth()->user()->fullName }}"
                            />
                        </button>
                    </div>

                    <!-- Dropdown menu -->
                    <div
                        x-show="open"
                        class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="user-menu-button"
                        tabindex="-1"
                        @click.away="open = false"
                    >
                        <x-dropdown-link
                            :href="route('profile.stats', auth()->user()->username)"
                            wire:navigate
                        >
                            {{ __('Your Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link
                            :href="route('edit-profile')"
                            wire:navigate
                        >
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button
                            wire:click="logout"
                            class="w-full text-start"
                        >
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex items-center -mr-2 sm:hidden">
                <!-- Mobile menu button -->
                <button
                    type="button"
                    class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                >
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg
                        x-show="!mobileMenuOpen"
                        class="block w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                        />
                    </svg>

                    <!-- Icon when menu is open -->
                    <svg
                        x-show="mobileMenuOpen"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div
        id="mobile-menu"
        x-show="mobileMenuOpen"
        class="sm:hidden"
    >
        <div class="pt-2 pb-3 space-y-1">
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img
                        class="w-10 h-10 rounded-full"
                        src="{{ auth()->user()->avatar }}"
                        alt="{{ auth()->user()->fullName }}"
                    />
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">
                        {{ auth()->user()->fullName }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link
                    :href="route('profile.stats', auth()->user()->username)"
                    wire:navigate
                >
                    {{ __('Create New Post') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('profile.stats', auth()->user()->username)"
                    wire:navigate
                >
                    {{ __('Your Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('edit-profile')"
                    wire:navigate
                >
                    {{ __('Edit Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button
                    wire:click="logout"
                    class="w-full text-start"
                >
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
