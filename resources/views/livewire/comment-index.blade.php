<div>
    <article
        class="min-w-full px-4 py-2 mx-auto bg-white border-2 border-black divide-y rounded-lg shadow max-w-none sm:px-6">
        @for ($chunk = 0; $chunk < $page; $chunk++)
            <livewire:comment-info :ids="$chunks[$chunk]" :key="$chunk" />
        @endfor
    </article>

    @if ($this->hasMorePages())
        <div x-intersect="$wire.loadMore" class="-translate-y-36"></div>
    @endif
</div>
