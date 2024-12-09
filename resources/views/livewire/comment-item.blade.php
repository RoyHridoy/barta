<div class="{{ $deleted ? 'border-transparent' : 'border-b border-gray-300 last-of-type:border-0' }}"
    x-data="{ openEdit: false, openReply: false }" x-on:edited="openEdit = false" x-on:replied="openReply = false">
    @if (!$deleted)
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
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1" @click.away="open = false">
                                    @can('edit', $comment)
                                        <button id="user-menu-item-0"
                                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                                            role="menuitem" tabindex="-1" @click="openEdit = true, open = false">Edit</button>
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
                <template x-if="openEdit">
                    <form wire:submit='edit'>
                        <x-textarea wire:model='commentEditForm.body'></x-textarea>
                        <x-input-error :messages="$errors->get('createCommentForm.body')"></x-input-error>

                        <div class="flex items-center gap-2">
                            <button type="submit"
                                class="flex items-center gap-2 px-4 py-2 mt-2 text-xs font-semibold text-white bg-gray-800 border-gray-800 rounded-full hover:bg-black">
                                Update
                            </button>
                            <button type="button"
                                class="flex items-center gap-2 px-4 py-2 mt-2 text-xs font-semibold text-gray-800 bg-white border border-gray-700 rounded-full hover:bg-gray-800 hover:text-white"
                                @click="openEdit = false">Cancel</button>
                        </div>
                    </form>
                </template>
            </div>
            <!-- Date Created & reply button -->
            <div class="flex items-center gap-4 text-xs text-gray-500">
                <span x-human-date datetime="{{ $comment->created_at->toDateTimeString() }}">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
                @can('reply', $comment)
                    <button x-on:click='openReply = true' type="button"
                        class="rounded bg-gray-300 px-2 py-0.5 text-gray-800">reply</button>
                @endcan
            </div>

            <!-- Child Comments -->
            @if (is_null($comment->parent_id) && $comment->children)
                @foreach ($comment->children as $child)
                    <div wire:key="{{ 'reply-' . $child->id }}" class="px-4 mt-4 ml-8 bg-gray-100 rounded-lg">
                        <livewire:comment-item :comment="$child" :key="'reply-' . $child->id">
                    </div>
                @endforeach

                {{-- Comment Reply form --}}
                <template x-if="openReply">
                    <form wire:submit='reply' class="pt-4 mt-4 ml-8 border-t border-t-gray-300">
                        <x-textarea wire:model='createReplyForm.body'
                            placeholder="Reply to {{ $comment->author->fullName }}"></x-textarea>
                        <x-input-error :messages="$errors->get('createReplyForm.body')"></x-input-error>

                        <div class="flex items-center gap-x-2">
                            <button type="submit"
                                class="flex items-center gap-2 px-4 py-2 mt-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
                                Reply
                            </button>
                            <button type="button"
                                class="flex items-center gap-2 px-4 py-2 mt-2 text-xs font-semibold text-gray-800 bg-white border border-gray-700 rounded-full hover:bg-gray-800 hover:text-white"
                                @click="openReply = false">Cancel</button>
                        </div>
                    </form>
                </template>
            @endif
        </div>
    @endif
</div>
