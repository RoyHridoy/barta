<x-app-layout>
    @guest
    <div class="p-12 text-center border border-gray-800 rounded-xl">
        <h1 class="items-center justify-center text-3xl">Welcome to Barta!</h1>
    </div>
    @endguest

    @auth
    @session('success')
        <x-flash type="success"/>
    @endsession
    <x-create-barta/>
    @endauth

    @forelse ($posts as $post)
        <x-article :post="$post"/>
    @empty
        <div>
            <h2 class="p-5 text-white rounded-md bg-black/80">No posts found.</h2>
        </div>
    @endforelse
    <div class="sm:-ml-10">
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
