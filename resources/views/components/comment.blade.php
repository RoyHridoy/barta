@props(['comment'])
<div class="py-4">
    <!-- Barta User Comments Top -->
    <header>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    @if ($comment->user->avatar)
                        <img
                        class="object-cover w-10 h-10 rounded-full"
                        src="{{ asset( 'storage/' . $comment->user->avatar ) }}"
                        alt="{{ $comment->user->fullName }}" />
                    @else
                        <img
                        class="object-cover w-10 h-10 rounded-full"
                        src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ $comment->user->fullName }}"
                        alt="{{ $comment->user->fullName }}" />
                    @endif
                </div>
                <!-- /User Avatar -->
                <!-- User Info -->
                <div class="flex flex-col flex-1 min-w-0 text-gray-900">
                <a
                    href="profile.html"
                    class="font-semibold hover:underline line-clamp-1">
                    {{ $comment->user->fullName }}
                </a>

                <a
                    href="profile.html"
                    class="text-sm text-gray-500 hover:underline line-clamp-1">
                    {{ '@' . $comment->user->username }}
                </a>
                </div>
                <!-- /User Info -->
            </div>

            @canany (['edit', 'delete'], $comment)
                <!-- Card Action Dropdown -->
                <div
                    class="flex self-center flex-shrink-0"
                    x-data="{ open: false }">
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
                            @can('edit', $comment)
                                <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-0"
                                >Edit</a
                                >
                            @endcan
                            @can('delete', $comment)
                                <button
                                form="delete-form-{{ $comment->id }}"
                                class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-1"
                                >Delete</button
                                >
                            @endcan
                        </div>
                    </div>
                </div>
                <!-- /Card Action Dropdown -->
            @endcanany
        </div>
    </header>
    <!-- Content -->
    <div class="py-4 font-normal text-gray-700">
        <p>{{ $comment->body }}</p>
    </div>
    <!-- Date Created -->
    <div class="flex items-center gap-2 text-xs text-gray-500">
        <span class="">{{ $comment->created_at->diffForHumans() }}</span>
    </div>
</div>
{{-- {{ $comment->post }} --}}
<form action="{{ route('comments.destroy', $comment->id) }}" method="POST" id="delete-form-{{ $comment->id }}" class="hidden">
    @csrf
    @method('DELETE')
</form>
