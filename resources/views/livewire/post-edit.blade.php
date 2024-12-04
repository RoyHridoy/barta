<div class="max-w-3xl mx-auto">
    @if (session('status'))
        <div class="px-4 py-2 mb-3 font-medium text-center rounded-md bg-emerald-300 text-emerald-900">
            {{ session('status') }}
        </div>
    @endif
    <!-- Barta Create Post Card -->
    <form wire:submit="update()" enctype="multipart/form-data"
        class="px-4 py-5 mx-auto space-y-3 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
        @csrf
        <div>
            <div class="flex flex-col gap-5 /space-x-3/">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img class="object-cover w-10 h-10 rounded-full" src="{{ auth()->user()->avatar }}"
                        alt="{{ auth()->user()->fullName }}">
                </div>
                <!-- /User Avatar -->
                <!-- Content -->
                <div class="w-full font-normal text-gray-700">
                    @if ($form->tempPhoto || $form->post->photo)
                        <img src="{{ $form->tempPhoto ? $form->tempPhoto->temporaryUrl() : asset('storage/' . $form->post->photo) }}"
                            class="object-cover w-full mb-3 rounded-lg min-h-auto max-h-80 md:max-h-96">
                    @endif
                    <div wire:loading>
                        <div class="flex items-center justify-center w-full h-48 mb-3 rounded-lg bg-slate-100"></div>
                    </div>
                    <textarea wire:model="form.barta"
                        class="block w-full p-2 text-gray-900 border rounded-lg outline-none min-h-48 focus:ring-0 focus:ring-offset-0"
                        rows="2" placeholder="What's going on, {{ auth()->user()->firstName }}?"></textarea>
                    @error('form.barta')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <div class="flex gap-4 text-gray-600">
                    <!-- Upload Picture Button -->
                    <div>
                        <input id="photo" wire:model="form.tempPhoto" type="file" name="photo"
                            class="hidden" />

                        <label for="photo"
                            class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full cursor-pointer hover:text-gray-800">
                            <span class="sr-only">Photo</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </label>
                        @error('form.tempPhoto')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /Upload Picture Button -->
                </div>
                <div>
                    <!-- Post Button -->
                    <div wire:loading.remove wire:target="form.tempPhoto">
                        <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 -m-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black disabled:opacity-50">
                            Post
                        </button>
                    </div>
                    <!-- /Post Button -->
                </div>
            </div>
        </div>
    </form>
</div>
