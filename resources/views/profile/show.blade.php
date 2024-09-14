<x-app-layout>
      <!-- Cover Container -->
      <section
        class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">
        <!-- Profile Info -->
        <div
          class="flex flex-col items-center justify-center gap-4 text-center">
          <!-- Avatar -->
          <div class="relative">
            @if (auth()->user()->avatar)
              <img
              class="w-32 h-32 border-2 border-gray-800 rounded-full"
              src="{{ asset("storage/".auth()->user()->avatar) }}"
              alt="{{ auth()->user()->firstName }}" />
            @else
              <svg
                class="w-32 h-32 text-gray-400 border-2 border-gray-500 rounded-full"
                viewBox="0 0 24 24"
                fill="currentColor"
                aria-hidden="true">
                <path
                  fill-rule="evenodd"
                  d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                  clip-rule="evenodd" />
              </svg>
            @endif
            <span
              class="bottom-2 right-4 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-500 rounded-full"></span>
          </div>
          <!-- /Avatar -->

          <!-- User Meta -->
          <div>
            <h1 class="font-bold md:text-2xl">{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</h1>
            <p class="text-gray-700">{{ auth()->user()->bio }}</p>
          </div>
          <!-- / User Meta -->
        </div>
        <!-- /Profile Info -->

        <!-- Edit Profile Button (Only visible to the profile owner) -->
        <a
          href="{{ route('edit-profile') }}"
          type="button"
          class="flex items-center gap-2 px-4 py-2 -m-2 font-semibold text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
          </svg>

          Edit Profile
        </a>
        <!-- /Edit Profile Button -->
      </section>

</x-app-layout>