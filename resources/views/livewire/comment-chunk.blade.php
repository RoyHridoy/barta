<div class="border-b border-gray-300 last:border-0">
    @foreach ($comments as $comment)
        <livewire:comment-item :$comment :key="$comment->id" />
    @endforeach
</div>
