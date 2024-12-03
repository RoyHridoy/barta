<x-app-layout>
    <div class="py-9">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Create Post --}}
            <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form method="POST" enctype="multipart/form-data"
                    class="px-4 py-5 mx-auto space-y-3 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
                    <div>
                        <div class="flex items-start /space-x-3/">
                            <!-- User Avatar -->
                            <div class="flex-shrink-0">
                                <img class="object-cover w-10 h-10 rounded-full"
                                    src="https://avatars.githubusercontent.com/u/831997" alt="Ahmed Shamim" />
                            </div>
                            <!-- /User Avatar -->

                            <!-- Content -->
                            <div class="w-full font-normal text-gray-700">
                                <textarea
                                    class="block w-full p-2 pt-2 text-gray-900 border-none rounded-lg outline-none focus:ring-0 focus:ring-offset-0"
                                    name="barta" rows="2" placeholder="What's going on, Shamim?"></textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex gap-4 text-gray-600">
                                <!-- Upload Picture Button -->
                                <div>
                                    <input id="picture" type="file" name="picture" class="hidden" />

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
                                <button type="submit"
                                    class="flex items-center gap-2 px-4 py-2 -m-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
                                    Post
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- All Posts --}}
            <section class="space-y-8">
                <!-- Barta Card -->
                <article class="px-4 py-5 mx-auto bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
                    <!-- Barta Card Top -->
                    <header>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <!-- User Avatar -->
                                <div class="flex-shrink-0">
                                    <img class="object-cover w-10 h-10 rounded-full"
                                        src="https://avatars.githubusercontent.com/u/61485238" alt="Al Nahian" />
                                </div>
                                <!-- /User Avatar -->

                                <!-- User Info -->
                                <div class="flex flex-col flex-1 min-w-0 text-gray-900">
                                    <a href="profile.html" class="font-semibold line-clamp-1 hover:underline">
                                        Al Nahian
                                    </a>

                                    <a href="profile.html" class="text-sm text-gray-500 line-clamp-1 hover:underline">
                                        @alnahian2003
                                    </a>
                                </div>
                                <!-- /User Info -->
                            </div>

                            <!-- Card Action Dropdown -->
                            <div class="flex self-center flex-shrink-0" x-data="{ open: false }">
                                <div class="relative inline-block text-left">
                                    <div>
                                        <button id="menu-0-button" type="button"
                                            class="flex items-center p-2 -m-2 text-gray-400 rounded-full hover:text-gray-600"
                                            @click="open = !open">
                                            <span class="sr-only">Open options</span>
                                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path
                                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Dropdown menu -->
                                    <div x-show="open"
                                        class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1" @click.away="open = false">
                                        <a id="user-menu-item-0" href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem" tabindex="-1">Edit</a>
                                        <a id="user-menu-item-1" href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem" tabindex="-1">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Card Action Dropdown -->
                        </div>
                    </header>

                    <!-- Content -->
                    <a href="./single.html">
                        <div class="py-4 font-normal text-gray-700">
                            <p>
                                🎉🥳 Turning 20 today! 🎂
                                <br />
                                One of the best things in my life has been my love affair with
                                <a href="#laravel" class="font-semibold text-black hover:underline">#Laravel</a>
                                <br />
                                <br />
                                Keep me in your prayers 😌
                            </p>
                        </div>
                    </a>

                    <!-- Date Created & View Stat -->
                    <div class="flex items-center gap-2 my-2 text-xs text-gray-500">
                        <span class="">6 minutes ago</span>
                        <span class="">•</span>
                        <span>450 views</span>
                    </div>

                    <!-- Barta Card Bottom -->
                    <footer class="pt-2 border-t border-gray-200">
                        <!-- Card Bottom Action Buttons -->
                        <div class="flex items-center justify-between">
                            <div class="flex gap-8 text-gray-600">
                                <!-- Comment Button -->
                                <a href="./single.html" type="button"
                                    class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                                    <span class="sr-only">Comment</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                    </svg>

                                    <p>0</p>
                                </a>
                                <!-- /Comment Button -->
                            </div>
                        </div>
                        <!-- /Card Bottom Action Buttons -->
                    </footer>
                    <!-- /Barta Card Bottom -->
                </article>
                <!-- /Barta Card -->
            </section>
        </div>
    </div>
</x-app-layout>
