<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

    <x-article-details :post="$post" />

    <hr class="pt-4 mt-8" />

    <div class="flex flex-col space-y-6">
        <h1 class="text-lg font-semibold">Comments <code> ({{ $post->comments_count }})</code></h1>
        @if ($post->comments_count > 0)
            <article
                class="min-w-full px-4 py-2 mx-auto bg-white border-2 border-black divide-y rounded-lg shadow max-w-none sm:px-6">
                @foreach ($post->comments as $comment)
                    <x-comment :comment="$comment" :post="$post" />
                @endforeach
            </article>
        @endif
    </div>
</div>
