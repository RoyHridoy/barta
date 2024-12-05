<div>

    <!-- Barta Create Comment Form -->
    <form action="" wire:submit="save()" method="POST">
        @csrf
        <div>
            <div class="flex items-start space-x-3">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->avatar }}"
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
                    }" x-init="resize()" @input="resize()" type="text" wire:model="form.body"
                        placeholder="Write a comment..."
                        class="border-sm ring-offset-background flex h-auto min-h-[40px] w-full rounded-lg border border-neutral-300 bg-gray-100 px-3 py-2 text-sm text-gray-900 placeholder:text-neutral-400 focus:border-neutral-300 focus:bg-white focus:outline-none focus:ring-1 focus:ring-neutral-400 focus:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                    @error('body')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit"
                class="mt-2 flex items-center gap-2 rounded-full bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-black">
                Comment
            </button>
        </div>
    </form>
</div>
