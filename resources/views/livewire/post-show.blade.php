<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

    <x-article-details :post="$post" />
    {{ $totalComments }}
    <hr class="pt-4 mt-8" />

    <div class="flex flex-col space-y-6">
        <h1 class="text-lg font-semibold">Comments <code> ({{ $post->comments_count }})</code></h1>
        @if ($post->comments_count > 0)
            <livewire:comment-index :post_id="$post->id" />
        @endif
    </div>
</div>
