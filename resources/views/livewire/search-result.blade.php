<div>
    <div
        class="absolute top-[calc(100%+5px)] max-h-96 w-full divide-y overflow-y-auto rounded border-2 border-gray-300 bg-white px-3 py-2 shadow-2xl"
        x-show="showSearchResult"
    >
        @forelse ($posts as $post)
            <a
                href="{{ route('posts.show', $post->id) }}"
                class="block py-2.5 text-gray-600 underline-offset-2 transition-all hover:text-gray-800 hover:underline"
                wire:navigate
            >{{ str($post->barta)->limit(30) }} by <span>{{ $post->author->fullName }}</span></a>
        @empty
            <p>Nothing Found</p>
        @endforelse
    </div>
</div>
