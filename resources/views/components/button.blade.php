@props(['type', 'secondary' => false])
<button type="{{ $type }}"
    class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 transition-all duration-300 {{ $secondary ? 'bg-black/40 hover:bg-black/60 focus-visible:outline-black text-white' : 'bg-black hover:bg-black/80 focus-visible:outline-black text-white' }}">
    {{ $slot }}
</button>