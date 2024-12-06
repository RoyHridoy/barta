<div class="divide-y">
    @foreach ($comments as $comment)
        <x-comment :comment="$comment" :key="$comment" />
    @endforeach
</div>
