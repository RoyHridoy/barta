<div>
    <div
        class="absolute top-[calc(100%+5px)] max-h-96 w-full divide-y overflow-y-auto rounded border-2 border-gray-300 bg-white px-3 py-2 shadow-2xl"
        {{ $show ? 'block' : 'hidden' }}
    >
        @forelse ($results as $result)
            <a
                href=""
                class="block py-2.5"
                wire:navigate
            >{{ str($result->barta)->limit(40) }}</a>
        @empty
            <p>Nothing Found</p>
        @endforelse
    </div>
    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</div>
