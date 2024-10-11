    <!-- Barta Create Post Card -->
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="relative px-4 py-5 mx-auto space-y-3 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
        @csrf
        <!-- Create Post Card Top -->
        <img class="object-cover w-full min-h-0 rounded-md opacity-0 -z-10" id="temp-photo" src="" />
        <div>
            <div class="relative flex items-start /space-x-3/">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    @if (auth()->user()->avatar)
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ asset( 'storage/' . auth()->user()->avatar ) }}" alt="{{ auth()->user()->fullName }}">
                    @else
                        <img class="object-cover w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->fullName }}" alt="{{ auth()->user()->fullName }}">
                    @endif
                </div>
                <!-- /User Avatar -->
                <!-- Content -->
                <div class="w-full font-normal text-gray-700">
                    <textarea
                        class="block w-full pt-2 ml-2 text-gray-900 border-none rounded-lg outline-none focus:ring-0 focus:ring-offset-0"
                        name="description"
                        rows="2"
                        placeholder="What's going on, {{ auth()->user()->firstName }}?">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>

        <!-- Create Post Card Bottom -->
        <div>
            <!-- Card Bottom Action Buttons -->
            <div class="flex items-center justify-between">
                <div class="flex gap-4 text-gray-600">
                    <!-- Upload Picture Button -->
                    <div>
                        <input
                        type="file"
                        name="image"
                        id="image"
                        class="hidden" />

                        <label
                        for="image"
                        class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full cursor-pointer hover:text-gray-800">
                            <span class="sr-only">Image</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6">
                                <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </label>
                        @error('image')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /Upload Picture Button -->
                </div>
                <div>
                    <!-- Post Button -->
                    <button
                        type="submit"
                        class="flex items-center gap-2 px-4 py-2 -m-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
                        Post
                    </button>
                    <!-- /Post Button -->
                </div>
            </div>
            <!-- /Card Bottom Action Buttons -->
        </div>
        <!-- /Create Post Card Bottom -->
    </form>
    <!-- /Barta Create Post Card -->
