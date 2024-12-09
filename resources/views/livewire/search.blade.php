<div
    x-data="{ showSearchResult: false }"
    @click.away="showSearchResult = false"
>
    <form class="relative">
        <input
            type="text"
            name="search"
            x-on:input="showSearchResult = $event.target.value.length > 0"
            wire:model.live.debounce.500='search'
            placeholder="Search here..."
            class="h-10 rounded-full border-2 border-gray-300 bg-white px-5 text-sm focus:border-gray-500 focus:outline-none focus:ring-0 sm:w-[400px]"
        >
        <livewire:search-result
            :posts="$posts"
            :show="strlen($search) > 0"
        />
    </form>
</div>
