<div class="mx-auto max-w-3xl">
    <!-- Barta Edit Post Card -->
    <form
        wire:submit="update"
        class="mx-auto max-w-none space-y-3 rounded-lg border-2 border-black bg-white px-4 py-5 shadow sm:px-6"
    >
        <div>
            <div class="/space-x-3/ flex flex-col gap-5">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img
                        class="h-10 w-10 rounded-full object-cover"
                        src="{{ auth()->user()->avatar }}"
                        alt="{{ auth()->user()->fullName }}"
                    >
                </div>
                <!-- /User Avatar -->
                <!-- Content -->
                <div class="w-full font-normal text-gray-700">
                    @if ($form->tempPhoto || $form->post->photo)
                        <img
                            src="{{ $form->tempPhoto ? $form->tempPhoto->temporaryUrl() : asset('storage/' . $form->post->photo) }}"
                            class="min-h-auto mb-3 max-h-80 w-full rounded-lg object-cover md:max-h-96"
                        >
                    @endif
                    <x-textarea wire:model='form.barta'></x-textarea>
                    <x-input-error :messages="$errors->get('form.barta')"></x-input-error>
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <div class="flex gap-4 text-gray-600">
                    <!-- Upload Picture Button -->
                    <div>
                        <input
                            id="photo"
                            wire:model="form.tempPhoto"
                            type="file"
                            name="photo"
                            class="hidden"
                        />

                        <label
                            for="photo"
                            class="-m-2 flex cursor-pointer items-center gap-2 rounded-full p-2 text-xs text-gray-600 hover:text-gray-800"
                        >
                            <span class="sr-only">Photo</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-6 w-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                                />
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
                    <div
                        wire:loading.remove
                        wire:target="form.tempPhoto"
                    >
                        <button
                            type="submit"
                            class="-m-2 flex items-center gap-2 rounded-full bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-black disabled:opacity-50"
                        >
                            Update
                        </button>
                    </div>
                    <!-- /Post Button -->
                </div>
            </div>
        </div>
    </form>

    <div class="mt-5 flex items-center justify-center">
        <a
            href="{{ route('home') }}"
            wire:navigate='true'
            class="underline-offset-2 hover:underline"
        >
            Back to Home page
        </a>
    </div>

    <x-action-message on="post-updated">
        {{ __('Profile Updated.') }}
    </x-action-message>
</div>
