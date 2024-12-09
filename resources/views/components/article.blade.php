@props(['post'])
<article class="px-4 py-5 mx-auto bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
    <header>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img class="object-cover w-10 h-10 rounded-full" src="{{ $post->author->avatar }}"
                        alt="{{ $post->author->fullName }}" />
                </div>
                <!-- /User Avatar -->

                <!-- User Info -->
                <div class="flex flex-col flex-1 min-w-0 text-gray-900">
                    <a href="https://github.com/alnahian2003" class="font-semibold line-clamp-1 hover:underline">
                        {{ $post->author->fullName }}
                    </a>

                    <a href="https://twitter.com/alnahian2003"
                        class="text-sm text-gray-500 line-clamp-1 hover:underline">
                        {{ '@' . $post->author->username }}
                    </a>
                </div>
                <!-- /User Info -->
            </div>

            @canany(['update', 'delete'], $post)
                <!-- Card Action Dropdown -->
                <div class="flex self-center flex-shrink-0" x-data="{ open: false }">
                    <div class="relative inline-block text-left">
                        <div>
                            <button id="menu-0-button" type="button"
                                class="flex items-center p-2 -m-2 text-gray-400 rounded-full hover:text-gray-600"
                                @click="open = !open">
                                <span class="sr-only">Open options</span>
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <!-- Dropdown menu -->
                        <div x-show="open"
                            class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                            @click.away="open = false">
                            @can('edit', $post)
                                <a href="{{ route('posts.edit', $post->id) }}" wire:navigate
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                    tabindex="-1">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <button wire:confirm="Are you really sure to delete the post?"
                                    wire:click="delete({{ $post->id }}); open = false"
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                                    role="menuitem" tabindex="-1">Delete</button>
                            @endcan
                        </div>
                    </div>
                </div>
            @endcanany
            <!-- /Card Action Dropdown -->
        </div>
    </header>

    <!-- Content -->
    <div class="py-4 space-y-2 font-normal text-gray-700">
        @if ($post->photo)
            <a href="{{ route('posts.show', $post->id) }}" wire:navigate class="flex justify-center mb-1 text-center">
                <img src="{{ asset('storage/' . $post->photo) }}" alt=""
                    class='object-cover w-full rounded-lg min-h-auto max-h-80 md:max-h-96' />
            </a>
        @endif
        <a href="{{ route('posts.show', $post->id) }}" wire:navigate>
            <p>{{ $post->barta }}</p>
        </a>
    </div>

    <!-- Date Created & View Stat -->
    <div class="flex items-center gap-2 my-2 text-xs text-gray-500">
        <span class="" x-human-date
            datetime="{{ $post->created_at->toDateTimeString() }}">{{ $post->created_at->diffForHumans() }}</span>
        <span class="">•</span>
        <span>{{ $post->views }} views</span>
    </div>

    <footer class="pt-2 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex gap-8 text-gray-600">
                <!-- Heart Button -->
                <button x-data="{ liked: false }" x-on:click="liked = !liked" type="button"
                    :class="{ 'text-gray-600': liked, 'text-gray-600': !liked }"
                    class="flex items-center gap-2 p-2 -m-2 text-xs rounded-full hover:text-gray-800">
                    <span class="sr-only">Like</span>
                    <!-- Show this icon when liked -->
                    <svg x-show="liked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5">
                        <path
                            d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                    </svg>
                    <!-- Show this icon when not liked -->
                    <svg x-show="!liked" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>

                    <p>{{ $post->likes }}</p>
                </button>
                <!-- /Heart Button -->

                <!-- Comment Button -->
                <a href="{{ route('posts.show', $post->id) }}" wire:navigate
                    class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                    <span class="sr-only">Comment</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>

                    <p>{{ $post->comments_count }}</p>
                </a>
                <!-- /Comment Button -->
            </div>
        </div>
    </footer>
</article>
