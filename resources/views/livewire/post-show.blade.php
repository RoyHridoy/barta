<div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
    <article class="mx-auto max-w-none rounded-t-lg border-2 border-b border-black border-b-gray-300 bg-white pb-2 pt-5">
        <header class="px-4 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            src="{{ $post->author->avatar }}"
                            alt="{{ $post->author->fullName }}"
                        />
                    </div>
                    <!-- /User Avatar -->

                    <!-- User Info -->
                    <div class="flex min-w-0 flex-1 flex-col text-gray-900">
                        <a
                            href="{{ route('profile.stats', $post->author->username) }}"
                            class="line-clamp-1 font-semibold hover:underline"
                        >
                            {{ $post->author->fullName }}
                        </a>

                        <a
                            href="{{ route('profile.stats', $post->author->username) }}"
                            class="line-clamp-1 text-sm text-gray-500 hover:underline"
                        >
                            {{ '@' . $post->author->username }}
                        </a>
                    </div>
                    <!-- /User Info -->
                </div>

                @canany(['update', 'delete'], $post)
                    <!-- Card Action Dropdown -->
                    <div
                        class="flex flex-shrink-0 self-center"
                        x-data="{ open: false }"
                    >
                        <div class="relative inline-block text-left">
                            <div>
                                <button
                                    id="menu-0-button"
                                    type="button"
                                    class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                    @click="open = !open"
                                >
                                    <span class="sr-only">Open options</span>
                                    <svg
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"
                                        >
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Dropdown menu -->
                            <div
                                x-show="open"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                                tabindex="-1"
                                @click.away="open = false"
                            >
                                @can('edit', $post)
                                    <a
                                        href="{{ route('posts.edit', $post->id) }}"
                                        wire:navigate
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem"
                                        tabindex="-1"
                                    >Edit</a>
                                @endcan
                                @can('delete', $post)
                                    <button
                                        wire:confirm="Are you really sure to delete the post?"
                                        wire:click="delete({{ $post->id }}); open = false"
                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem"
                                        tabindex="-1"
                                    >Delete</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endcanany
            </div>
        </header>

        <!-- Content -->
        <div class="space-y-2 px-4 py-4 font-normal text-gray-700 sm:px-6">
            @if ($post->photo)
                <div class="mb-1 flex justify-center text-center">
                    <img
                        src="{{ asset('storage/' . $post->photo) }}"
                        alt=""
                        class="min-h-auto h-full w-full rounded-lg object-cover"
                    />
                </div>
            @endif
            <p>{{ $post->barta }}</p>
        </div>

        <footer class="border-t border-gray-200 px-4 pt-2 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex gap-8 text-gray-600">
                    <button
                        x-data="{ liked: {{ $post->likedBy(auth()->user()) }} }"
                        x-on:click="liked = !liked"
                        wire:click="toggleLike({{ $post->id }})"
                        type="button"
                        :class="{ 'text-gray-600': liked, 'text-gray-600': !liked }"
                        class="-m-2 flex items-center gap-2 rounded-full p-2 text-xs hover:text-gray-800"
                    >
                        <span class="sr-only">Like</span>
                        <!-- Show this icon when liked -->
                        <svg
                            x-show="liked"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"
                            />
                        </svg>
                        <!-- Show this icon when not liked -->
                        <svg
                            x-show="!liked"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
                            />
                        </svg>

                        <p>{{ $post->getTotalLike() }}</p>
                    </button>
                </div>
                <!-- Date Created & View Stat -->
                <div class="my-2 flex items-center gap-2 text-xs text-gray-500">
                    <span
                        class=""
                        x-human-date
                        datetime="{{ $post->created_at->toDateTimeString() }}"
                    >{{ $post->created_at->diffForHumans() }}</span>
                    <span class="">•</span>
                    <span>{{ $post->views }} views</span>
                </div>
            </div>
        </footer>
    </article>
    <!-- /Barta Card -->

    <livewire:comments :$post />
</div>
