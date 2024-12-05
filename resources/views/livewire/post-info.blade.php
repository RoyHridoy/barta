<div class="mt-8 space-y-8">
    @foreach ($posts as $post)
        <x-article :post="$post" :key="$post->id" />
    @endforeach
</div>
