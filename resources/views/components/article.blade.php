@props(['post', 'isSmallPost' => str()->of($post->description)->wordCount() < 15, 'isPostDetailsPage' => false ])
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
                href="{{ route('profileView', $post->user->username) }}"
                class="font-semibold hover:underline line-clamp-1">
                {{ $post->user->fullName }}
            </a>

            <a
                href="{{ route('profileView', $post->user->username) }}"
                class="text-sm text-gray-500 hover:underline line-clamp-1">
                {{ '@' . $post->user->username }}
            </a>
            </div>
            <!-- /User Info -->
        </div>

        @canany(['edit', 'delete'], $post)
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
                    href="{{ route('posts.edit', $post->id) }}"
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
        @endcanany
        </div>
    </header>

    <!-- Content -->
    <div class="pt-4 pb-1 font-normal text-gray-700">
        <a href="{{ route('posts.show', $post->id) }}">
            <img
            src="{{ asset('storage/' . $post->image) }}"
            class="object-cover w-full mb-3 rounded-lg min-h-auto {{ $isPostDetailsPage ? '' : 'max-h-64 md:max-h-72' }}"
            alt="" />
        </a>
        @if ($isSmallPost || $isPostDetailsPage)
            {{ $post->description }}
        @else
            {{ str()->words($post->description,14) }}
            <a href="{{ route('posts.show', $post->id) }}" class="text-sm text-blue-500">See Details</a>
        @endif
    </div>

    <!-- Date Created & View Stat -->
    <div class="flex items-center gap-2 my-2 text-xs text-gray-500">
        <span class="">{{ $post->created_at->diffForHumans() }}</span>
        @if ($isPostDetailsPage)
            <span class="">•</span>
            <span>{{ count($post->comments) }} comments</span>
        @endif
    </div>

    @if ($isPostDetailsPage && auth()->user())
        <hr class="my-6" />
        <!-- Barta Create Comment Form -->
        <form
        action="{{ route('comments.store', $post->id) }}"
        method="POST">
        @csrf
            <!-- Create Comment Card Top -->
            <div>
                <div class="flex items-start space-x-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        @if (auth()->user()->avatar)
                            <img class="object-cover w-10 h-10 rounded-full" src="{{ asset( 'storage/' . auth()->user()->avatar ) }}" alt="{{ auth()->user()->fullName }}">
                        @else
                            <img class="object-cover w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->fullName }}" alt="{{ auth()->user()->fullName }}">
                        @endif
                    </div>
                    <!-- /User Avatar -->

                    <!-- Auto Resizing Comment Box -->
                    <div class="w-full font-normal text-gray-700">
                        <textarea
                            x-data="{
                                resize () {
                                    $el.style.height = '0px';
                                    $el.style.height = $el.scrollHeight + 'px'
                                }
                            }"
                            x-init="resize()"
                            @input="resize()"
                            type="text"
                            name="body"
                            placeholder="Write a comment..."
                            class="flex w-full h-auto min-h-[40px] px-3 py-2 text-sm bg-gray-100 focus:bg-white border border-sm rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 text-gray-900"></textarea>
                            @error('body')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
            </div>

            <!-- Create Comment Card Bottom -->
            <div>
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-end">
                    <button
                    type="submit"
                    class="flex items-center gap-2 px-4 py-2 mt-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
                    Comment
                    </button>
                </div>
                <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Comment Card Bottom -->
        </form>
        <!-- /Barta Create Comment Form -->
    @endif

    @if (!$isPostDetailsPage)
    <!-- Barta Card Bottom -->
    <footer class="pt-2 border-t border-gray-200">
        <!-- Card Bottom Action Buttons -->
        <div class="flex items-center justify-between">
            <div class="flex gap-8 text-gray-600">
            <!-- Comment Button -->
            <a
                href="{{ route('posts.show', $post->id) }}"
                type="button"
                class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                <span class="sr-only">Comment</span>
                <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="w-5 h-5">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                </svg>

                <p>{{ $post->comments_count }}</p>
            </a>
            <!-- /Comment Button -->
            </div>
        </div>
        <!-- /Card Bottom Action Buttons -->
    </footer>
    <!-- /Barta Card Bottom -->
    @endif

    <form action="{{ route('posts.show', $post->id) }}" method="POST" id="delete-form-{{ $post->id }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</article>
