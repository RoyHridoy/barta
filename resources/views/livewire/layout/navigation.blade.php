<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;

new class extends Component {
    public $notifications;
    public $totalUnreadNotifications;

    protected $notificationMessages = [
        'comment-created' => 'commented on your post.',
        'comment-reply' => 'replied on your comment.',
    ];

    public function mount()
    {
        $this->setNotifications();
    }

    #[On('new-notification')]
    public function setNotifications()
    {
        $this->notifications = auth()->user()->notifications;
        $this->totalUnreadNotifications = auth()->user()->unreadNotifications->count();
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->setNotifications();
        $this->totalUnreadNotifications = 0;
    }

    public function goToNotification($notificationId, $postId)
    {
        $this->markRead($notificationId);
        return $this->redirectRoute('posts.show', $postId, navigate: true);
    }

    public function markRead($notificationId)
    {
        $notification = DatabaseNotification::find($notificationId);
        $notification->markAsRead();
    }

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
            <div class="hidden gap-4 sm:ml-6 sm:flex sm:items-center">
                <div
                    x-data="{ open: false }"
                    class="relative flex items-center gap-x-5"
                    x-init="Echo.private('App.Models.User.{{ auth()->user()->id }}')
                        .notification((notification) => {
                            $dispatch('new-notification')
                        })"
                >
                    <div>
                        <button
                            type="button"
                            class="relative p-2 text-gray-800 rounded-full hover:bg-gray-300 focus:outline-none"
                            :class="{ 'bg-gray-300': open }"
                            @click="open = !open"
                        >
                            <span class="sr-only">View notifications</span>
                            <!-- Heroicon name: outline/bell -->
                            <svg
                                class="w-6 h-6"
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
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
                                />
                            </svg>
                            @if ($this->totalUnreadNotifications)
                                <span
                                    class="absolute top-0 right-0 flex items-center justify-center text-xs text-white bg-black rounded-full size-5"
                                >{{ $this->totalUnreadNotifications }}</span>
                            @endif
                        </button>
                    </div>
                    <div
                        x-show="open"
                        class="absolute right-0 top-full z-10 m-auto mt-2 max-h-[calc(50vh)] origin-top-right divide-y overflow-y-auto rounded-md bg-white p-2 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        @click.away="open = false"
                    >
                        <div class="w-80">
                            <div class="flex justify-between px-2 mb-3">
                                <p>All</p>
                                <button
                                    wire:click='markAllRead'
                                    class="text-blue-600 underline underline-offset-2"
                                >Mark All</button>
                            </div>
                            <div class="flex flex-col">
                                @foreach ($this->notifications as $notification)
                                    <div
                                        wire:click="goToNotification('{{ $notification->id }}', '{{ $notification->data['postId'] }}')"
                                        wire:key="{{ $notification->id }}"
                                        x-data="{ notificationType: '{{ $notification->type }}' }"
                                        class="{{ $notification->read_at == null ? 'opacity-100' : 'opacity-50' }} flex cursor-pointer items-center gap-x-3 rounded border-b p-2 transition-all last:border-0 hover:bg-gray-100"
                                    >
                                        <div
                                            class="flex items-center justify-center flex-shrink-0 bg-gray-200 rounded-full size-10">
                                            <svg
                                                x-show="notificationType == 'comment-reply'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                shape-rendering="geometricPrecision"
                                                text-rendering="geometricPrecision"
                                                image-rendering="optimizeQuality"
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                viewBox="0 0 512 451.41"
                                                class="w-5 h-5"
                                            >
                                                <path
                                                    d="M215.05 391.35c53.62 51.73 129.47 67.36 205.31 35.04l63.65 25.02-21.09-50.15c70.72-56.64 58.06-134.5 6-187.56-3.48 20.4-10.39 39.73-20.23 57.61-13.98 25.43-34 48.02-58.52 66.63-23.76 18.04-51.5 32.18-81.73 41.32-28.8 8.72-60.35 13.06-93.38 12.09h-.01zM107.18 164.74l83.8 84.56v-42.18c13.23-2.65 25.78-3.93 37.63-3.77 11.87.18 23.09 1.93 33.62 5.27 10.53 3.39 20.42 8.35 29.58 14.95 9.21 6.59 17.81 14.94 25.87 24.96-1.33-20.56-5.7-38.58-13.06-54.08-7.37-15.46-16.75-28.39-28.22-38.75-11.43-10.36-24.49-18.24-39.14-23.6-14.64-5.34-30.05-8.34-46.28-9.03v-42.9l-83.8 84.57zM278.32 6.61c39.61 8.97 74.76 26.62 102.21 50.15 39.68 34.02 63.47 80.32 61.98 130.88v.11c-.82 27.28-8.94 52.92-22.79 75.74-14.25 23.47-34.48 43.88-58.99 59.94-32.34 21.19-72.82 34.3-114.06 38.2-38.57 3.64-77.97-.77-112.17-14.13L5.4 401.86l53.89-98.52c-17.84-15.85-32.3-34.24-42.46-54.37C5.3 226.12-.72 201.02.07 174.8c1.53-50.62 28.09-95.52 69.8-127.17 25.44-19.3 56.56-33.68 91.03-41.34 38.31-8.52 79.12-8.35 117.42.32zM169.34 32.95c-31.45 6.63-59.74 19.47-82.65 36.85-35.14 26.67-57.51 64.04-58.77 105.76-.65 21.44 4.32 42.03 13.82 60.85 10.02 19.86 25.06 37.78 43.88 52.69l9.22 7.31-26.7 48.81 66.36-27.94 5.4 2.3c31.12 13.27 67.94 17.72 104.15 14.3 36.8-3.48 72.79-15.09 101.39-33.83 21.16-13.86 38.48-31.23 50.47-50.98 11.4-18.78 18.07-39.81 18.75-62.08v-.12c1.23-41.69-18.83-80.26-52.26-108.91-23.1-19.81-52.5-34.89-85.71-43.11-34.76-8.61-72.33-9.28-107.35-1.9z"
                                                />
                                            </svg>
                                            <svg
                                                x-show="notificationType == 'comment-created'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                class="w-5 h-5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z"
                                                ></path>
                                            </svg>
                                            <svg
                                                x-show="notificationType == 'post-liked'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="w-5 h-5"
                                            >
                                                <path
                                                    d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <div class="flex flex-col gap-1">
                                            <p>
                                                {{ $notification->data['senderName'] }}
                                                {{ $this->notificationMessages[$notification->type] }}
                                            </p>
                                            <div class="flex justify-end text-xs">
                                                <span
                                                    class="font-semibold text-gray-700">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

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
