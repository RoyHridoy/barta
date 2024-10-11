<x-app-layout :isLargeLayout="true">
    @session('success')
        <x-flash type="success"/>
    @endsession
    <x-article :post="$post" :isPostDetailsPage="true"/>

    <hr />
    <div class="flex flex-col space-y-6">
        <h1 class="text-lg font-semibold">Comments <code> ({{ $post->comments_count }})</code></h1>
        @if ($post->comments_count > 0)
        <article class="min-w-full px-4 py-2 mx-auto bg-white border-2 border-black divide-y rounded-lg shadow max-w-none sm:px-6">
            <!-- Comments -->
            @foreach ($post->comments as $comment)
                <x-comment :comment="$comment" :post="$post"/>
            @endforeach
            <!-- /Comments -->
        </article>
        @endif
    </div>

</x-app-layout>
