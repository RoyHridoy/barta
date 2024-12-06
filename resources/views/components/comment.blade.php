@props(['comment', 'post'])
<div x-data="{ openEdit: false }">
    <div class="py-4">
        <!-- Barta User Comments Top -->
        <header>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ $comment->author->avatar }}"
                            alt="{{ $comment->author->fullName }}" />
                    </div>
                    <!-- /User Avatar -->
                    <!-- User Info -->
                    <div class="flex flex-col flex-1 min-w-0 text-gray-900">
                        <a href="" class="font-semibold line-clamp-1 hover:underline">
                            {{ $comment->author->fullName }}
                            {{-- @if ($comment->user_id == $post->author->id)
                                <span
                                    class="relative -top-0.5 inline-block bg-blue-200 px-1 text-[9px] font-semibold uppercase text-blue-700">author</span>
                            @endif --}}
                        </a>

                        <a href="" class="text-sm text-gray-500 line-clamp-1 hover:underline">
                            {{ '@' . $comment->author->username }}
                        </a>
                    </div>
                    <!-- /User Info -->
                </div>

                @canany(['edit', 'delete'], $comment)
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
                                @can('edit', $comment)
                                    <button id="user-menu-item-0"
                                        class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                                        role="menuitem" tabindex="-1" @click="openEdit = true,  open = false">Edit</a>
                                    @endcan
                                    @can('delete', $comment)
                                        <button id="user-menu-item-1" wire:click="delete({{ $comment->id }}); open = false"
                                            wire:confirm="Are you really sure to delete this comment?"
                                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                                            role="menuitem" tabindex="-1">Delete</button>
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
            <p x-show="!openEdit">{{ $comment->body }}</p>

            {{-- Comment Update form --}}
            <div x-show="openEdit">
                <form method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="right-0 float-right px-2 mb-1 text-white bg-red-500 rounded-md"
                        @click="openEdit = false">X</button>
                    <textarea x-data="{
                        resize() {
                            $el.style.height = '0px';
                            $el.style.height = $el.scrollHeight + 70 + 'px'
                        }
                    }" x-init="resize()" @input="resize()" type="text" name="body"
                        class="border-sm ring-offset-background mb-1 flex h-auto min-h-[40px] w-full rounded-lg border border-neutral-300 bg-gray-100 px-3 py-2 text-sm text-gray-900 placeholder:text-neutral-400 focus:border-neutral-300 focus:bg-white focus:outline-none focus:ring-1 focus:ring-neutral-400 focus:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50">{{ $comment->body }}</textarea>
                    <div class="flex items-center">
                        <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 mt-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Date Created -->
        <div class="flex items-center gap-2 text-xs text-gray-500">
            <span class="">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
    </div>
</div>
