<div>
    {{-- Create Post --}}
    <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <form wire:submit="save"
            class="px-4 py-5 mx-auto space-y-3 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
            <div>
                <div class="flex items-start">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ auth()->user()->avatar }}"
                            alt="{{ auth()->user()->fullName }}" />
                    </div>
                    <!-- /User Avatar -->

                    <!-- Content -->
                    <div class="w-full font-normal text-gray-700">
                        <textarea wire:model="form.barta"
                            class="block w-full p-2 pt-2 text-gray-900 border-none rounded-lg outline-none focus:ring-0 focus:ring-offset-0"
                            name="barta" rows="2" placeholder="What's going on, {{ auth()->user()->firstName }}?"></textarea>
                    </div>
                </div>
            </div>

            @if ($form->tempPhoto)
                <img src="{{ $form->tempPhoto->temporaryUrl() }}">
            @endif

            <div>
                <div class="flex items-center justify-between">
                    <div class="flex gap-4 text-gray-600">
                        <!-- Upload Picture Button -->
                        <div>
                            <input id="picture" type="file" class="hidden" wire:model="form.tempPhoto" />

                            <label for="picture"
                                class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full cursor-pointer hover:text-gray-800">
                                <span class="sr-only">Picture</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </label>
                        </div>
                        <!-- /Upload Picture Button -->
                    </div>

                    <div>
                        <button type="submit" wire:dirty.remove.attr='disabled' disabled
                            class="flex items-center gap-2 px-4 py-2 -m-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black disabled:opacity-50">
                            Post
                        </button>
                    </div>
                </div>
            </div>
            @error('form.barta')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            @error('form.tempPhoto')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </form>
    </div>

    {{-- All posts as chunks --}}
    @for ($chunk = 0; $chunk < $page; $chunk++)
        <livewire:PostInfo :ids="$chunks[$chunk]" :key="json_encode($chunks[$chunk])" />
    @endfor

    {{-- Pagination --}}
    @if ($this->hasMorePages())
        <div x-intersect="$wire.loadMore" class="-translate-y-36"></div>
    @endif
</div>
