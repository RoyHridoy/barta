<x-app-layout :isLargeLayout="true">
      <!-- Cover Container -->
      <section
        class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">
        <!-- Profile Info -->
        <div
          class="flex flex-col items-center justify-center gap-4 text-center">
          <!-- Avatar -->
          <div class="relative">
            @if ($user->avatar)
              <img
              class="w-32 h-32 border-2 border-gray-800 rounded-full"
              src="{{ asset("storage/".$user->avatar) }}"
              alt="{{ $user->fullName }}" />
            @else
            <img class="w-32 h-32 border-2 border-gray-800 rounded-full" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ $user->fullName }}" alt="{{ $user->fullName }}">
            @endif
            <span
              class="bottom-2 right-4 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-500 rounded-full"></span>
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
        <div
        class="flex flex-row items-center justify-center gap-16 text-center">
        <!-- Total Posts Count -->
        <div class="flex flex-col items-center justify-center">
            <h4 class="font-bold sm:text-xl">{{ $posts->total() }}</h4>
            <p class="text-gray-600">Posts</p>
        </div>

        <!-- Total Comments Count -->
        <div class="flex flex-col items-center justify-center">
            <h4 class="font-bold sm:text-xl">{{ $totalComments }}</h4>
            <p class="text-gray-600">Comments</p>
        </div>
        </div>
        <!-- /Profile Stats -->

        @if ($user->id === auth()->user()->id)
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
        @endif
    </section>

    @if($user->id === auth()->user()->id)
        {{-- Create Barta --}}
        <x-create-barta/>
    @endif


    @forelse ($posts as $post)
        <x-article :post="$post"/>
    @empty
        <div>
            <h2 class="p-5 text-white rounded-md bg-black/80">You haven't create any barta</h2>
        </div>
    @endforelse
    <div>
        {{ $posts->links() }}
    </div>
</x-app-layout>

<script>
	const uploadAvatarButton = document.querySelector("#image");
	uploadAvatarButton.addEventListener("change", showAvatar);

	function showAvatar(event) {
		let image = document.getElementById("temp-photo");
		image.src = URL.createObjectURL(event.target.files[0]);
		image.classList.add('opacity-100');
	};
</script>
