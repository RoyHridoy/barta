<div class="mx-auto max-w-3xl sm:px-6 lg:px-8">

    <x-article-details :post="$post" />

    <hr class="mt-8 pt-4" />

    <div class="flex flex-col space-y-6">
        <h1 class="text-lg font-semibold">Comments <code> ({{ $post->comments_count }})</code></h1>
        @if ($post->comments_count > 0)
            <article
                class="mx-auto min-w-full max-w-none divide-y rounded-lg border-2 border-black bg-white px-4 py-2 shadow sm:px-6">
                @foreach ($post->comments as $comment)
                    <x-comment :comment="$comment" :post="$post" :key="$comment" />
                @endforeach
            </article>
        @endif
    </div>
</div>
