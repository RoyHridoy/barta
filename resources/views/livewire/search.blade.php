<div>
    <form class="relative">
        <input
            type="text"
            name="search"
            wire:model.live.debounce.250='search'
            placeholder="Search here..."
            class="h-10 rounded-full border-2 border-gray-300 bg-white px-5 text-sm focus:border-gray-500 focus:outline-none focus:ring-0 sm:w-[400px]"
        >
        <livewire:search-result
            :results="$results"
            :show="strlen($search) > 0"
        />
    </form>
</div>
