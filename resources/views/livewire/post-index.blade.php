<div>
    @for ($chunk = 0; $chunk < $page; $chunk++)
        <livewire:PostInfo :ids="$chunks[$chunk]" :key="$chunk" />
    @endfor

    @if ($this->hasMorePages())
        <div x-intersect="$wire.loadMore" class="-translate-y-36"></div>
    @endif
</div>
