<div>
    <!-- Barta Create Comment Form -->
    <form wire:submit="createComment"
        class="px-4 bg-white border-2 border-t-0 border-black rounded-b-lg border-t-transparent py-7">
        <div>
            <div class="flex items-start space-x-3">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img class="object-cover w-10 h-10 rounded-full" src="{{ auth()->user()->avatar }}"
                        alt="{{ auth()->user()->fullName }}" />
                </div>
                <!-- /User Avatar -->

                <!-- Auto Resizing Comment Box -->
                <div class="w-full font-normal text-gray-700">
                    <textarea x-data="{
                        resize() {
                            $el.style.height = '0px';
                            $el.style.height = $el.scrollHeight + 'px'
                        }
                    }" x-init="resize()" @input="resize()" type="text"
                        wire:model="createCommentForm.body" placeholder="Write a comment..."
                        class="border-sm ring-offset-background flex h-auto min-h-[40px] w-full rounded-lg border border-neutral-300 bg-gray-100 px-3 py-2 text-sm text-gray-900 placeholder:text-neutral-400 focus:border-neutral-300 focus:bg-white focus:outline-none focus:ring-1 focus:ring-neutral-400 focus:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                    @error('createCommentForm.body')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" wire:target="createCommentForm.body" wire:dirty
                class="flex items-center gap-2 px-4 py-2 mt-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
                Comment
            </button>
        </div>
    </form>

    <div class="flex flex-col space-y-6">
        <h1 class="pb-4 mt-6 text-lg font-semibold border-b border-b-gray-300">
            Comments <code> ({{ $this->totalComments }})</code>
        </h1>
        @if ($this->totalComments)
            <div class="px-4 py-5 bg-white border-2 border-black rounded-lg">
                @for ($chunk = 0; $chunk < $page; $chunk++)
                    <livewire:comment-chunk :ids="$chunks[$chunk]" :key="json_encode($chunks[$chunk])" />
                @endfor
            </div>
        @endif

        @if ($this->hasMorePages())
            <div class="flex items-center self-center justify-center mt-10">
                <x-primary-button wire:click='loadMore'>Load More</x-primary-button>
            </div>
        @endif
    </div>
</div>
