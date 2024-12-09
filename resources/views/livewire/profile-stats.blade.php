<div>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <!-- Cover Container -->
            <div
                class="flex min-h-[400px] flex-col items-center justify-center space-y-8 rounded-xl border-2 border-gray-800 bg-white p-8">
                <!-- Profile Info -->
                <div class="flex flex-col items-center justify-center gap-4 text-center">
                    <!-- Avatar -->
                    <div class="relative">
                        <img
                            class="w-32 h-32 border-2 border-gray-800 rounded-full"
                            src="{{ $user->avatar }}"
                            alt="{{ $user->fullName }}"
                        >
                        <span
                            class="absolute bottom-2 right-4 h-3.5 w-3.5 rounded-full border-2 border-white bg-green-400 dark:border-gray-500"
                        ></span>
                    </div>
                    <!-- /Avatar -->

                    <!-- User Meta -->
                    <div>
                        <h1 class="font-bold md:text-2xl">{{ $user->fullName }}</h1>
                        <p class="text-gray-700">{{ $user->bio }}</p>
                    </div>
                    <!-- / User Meta -->
                </div>
                <!-- /Profile Info -->

                <!-- Profile Stats -->
                <div class="flex flex-row items-center justify-center gap-16 text-center">
                    <!-- Total Posts Count -->
                    <div class="flex flex-col items-center justify-center">
                        <h4 class="font-bold sm:text-xl">{{ $user->posts_count }}</h4>
                        <p class="text-gray-600">Posts</p>
                    </div>

                    <!-- Total Comments Count -->
                    <div class="flex flex-col items-center justify-center">
                        <h4 class="font-bold sm:text-xl">{{ $user->comments_count }}</h4>
                        <p class="text-gray-600">Comments</p>
                    </div>
                </div>
                <!-- /Profile Stats -->

                @if ($user->id === auth()->user()->id)
                    <!-- Edit Profile Button (Only visible to the profile owner) -->
                    <a
                        href="{{ route('edit-profile') }}"
                        type="button"
                        class="flex items-center gap-2 px-4 py-2 -m-2 font-semibold text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                            />
                        </svg>

                        Edit Profile
                    </a>
                    <!-- /Edit Profile Button -->
                @endif
            </div>
        </div>

        <div class="flex items-center justify-center my-10">
            <h2 class="inline-block px-5 text-2xl font-medium text-center border-b-4 border-double border-b-gray-600">
                All Posts</h2>
        </div>

        <div class="mt-8">
            <livewire:post-index :user="$user" />
        </div>
    </div>
</div>
