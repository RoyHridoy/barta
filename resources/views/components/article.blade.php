@props(['post', 'postDetails' => str()->of($post->description)->wordCount() < 15 ])
<article
    class="px-4 py-5 mx-auto bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
    <!-- Barta Card Top -->
    <header>
        <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
                @if ($post->user->avatar)
                    <img
                    class="object-cover w-10 h-10 rounded-full"
                    src="{{ asset( 'storage/' . $post->user->avatar ) }}"
                    alt="{{ $post->user->fullName }}" />
                @else
                    <img
                    class="object-cover w-10 h-10 rounded-full"
                    src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ $post->user->fullName }}"
                    alt="{{ $post->user->fullName }}" />
                @endif
            </div>

            <!-- User Info -->
            <div class="flex flex-col flex-1 min-w-0 text-gray-900">
            <a
                href="#"
                class="font-semibold hover:underline line-clamp-1">
                {{ $post->user->fullName }}
            </a>

            <a
                href="#"
                class="text-sm text-gray-500 hover:underline line-clamp-1">
                {{ '@' . $post->user->username }}
            </a>
            </div>
            <!-- /User Info -->
        </div>

        @can(['edit', 'delete'], $post)
        <!-- Card Action Dropdown -->
        <div class="flex self-center flex-shrink-0" x-data="{ open: false }">
            <div class="relative inline-block text-left">
            <div>
                <button
                        @click="open = !open"
                        type="button"
                        class="flex items-center p-2 -m-2 text-gray-400 rounded-full hover:text-gray-600"
                        id="menu-0-button">
                <span class="sr-only">Open options</span>
                <svg
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                    <path
                            d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                </svg>
                </button>
            </div>
            <!-- Dropdown menu -->

            <div
                x-show="open"
                @click.away="open = false"
                class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="user-menu-button"
                tabindex="-1">
                <a
                    href="/posts/{{ $post->id }}/edit"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    role="menuitem"
                    tabindex="-1"
                    id="user-menu-item-0"
                >Edit</a
                >
                <button
                        form="delete-form-{{ $post->id }}"
                        class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-1"
                >Delete</button
                >
            </div>
            </div>
        </div>
        <!-- /Card Action Dropdown -->
        @endcan
        </div>
    </header>

    <!-- Content -->
    <div class="pt-4 pb-1 font-normal text-gray-700">
        <a href="{{ route('posts.show', $post->id) }}">
            <img
            src="{{ asset('storage/' . $post->image) }}"
            class="object-cover w-full mb-3 rounded-lg min-h-auto {{ $postDetails ? '' : 'max-h-64 md:max-h-72' }}"
            alt="" />
        </a>
        @if ($postDetails)
            {{ $post->description }}
        @else
            {{ str()->words($post->description,12) }}
            <a href="posts/{{ $post->id }}" class="text-sm text-blue-500">See Details</a>
        @endif
    </div>

    <!-- Date Created & View Stat -->
    <div class="flex items-center gap-2 my-2 text-xs text-gray-500">
        <span class="">{{ $post->created_at->diffForHumans() }}</span>
        <span class="">•</span>
        <span>4,450 views</span>
    </div>
    <form action="posts/{{ $post->id }}" method="POST" id="delete-form-{{ $post->id }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</article>
