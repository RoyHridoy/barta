<x-app-layout>
	<!-- Profile Edit Form -->

	<form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PATCH')
		<div class="space-y-12">
			<div class="pb-12 border-b border-gray-900/10">
				@session('success')
					<div class="p-2 font-bold text-center text-teal-900 bg-teal-300 rounded">
						{{ session('success') }}
					</div>
				@endsession

				<h2 class="mt-2 text-xl font-semibold leading-7 text-gray-900">
					Edit Profile
				</h2>
				<p class="mt-1 text-sm leading-6 text-gray-600">
					This information will be displayed publicly so be careful what you
					share.
				</p>

				<div class="pb-12 mt-10 border-b border-gray-900/10">
					<div class="pb-10 mt-10 col-span-full">
						<label class="block text-sm font-medium leading-6 text-gray-900">Avatar</label>
						<div class="relative flex items-center mt-2 gap-x-3">
							<input class="hidden" type="file" name="avatar" id="avatar" />
							<img class="absolute left-0 object-cover w-12 h-12 rounded-full opacity-0" id="temp-photo" src="" />
							@if (auth()->user()->avatar)
								<img class="object-cover w-12 h-12 rounded-full" id="photo" src="{{ asset("storage/".auth()->user()->avatar, ) }}" alt="{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}" />
							@else
							<svg class="w-12 h-12 text-gray-300 border-2 rounded-full" viewBox="0 0 24 24" fill="currentColor"
								aria-hidden="true">
								<path fill-rule="evenodd"
								d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
								clip-rule="evenodd" />
							</svg>
							@endif
							<label for="avatar">
								<div
									class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
									Change
								</div>
							</label>
							
						</div>
						<p class="mt-1 text-sm text-slate-400">* image size must be under 500kb</p>
						@error('avatar')
						<span class="text-sm text-red-500">{{ $message }}</span>
						@enderror
					</div>

					<div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
						<div class="sm:col-span-3">
							<label for="firstName" class="block text-sm font-medium leading-6 text-gray-900">First
								name</label>
							<div class="mt-2">
								<input type="text" name="firstName" id="firstName" autocomplete="given-name"
									value="{{ auth()->user()->firstName }}"
									class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
							</div>
							@error('firstName')
							<span class="text-sm text-red-500">{{ $message }}</span>
							@enderror
						</div>

						<div class="sm:col-span-3">
							<label for="lastName" class="block text-sm font-medium leading-6 text-gray-900">Last
								name</label>
							<div class="mt-2">
								<input type="text" name="lastName" id="lastName" value="{{ auth()->user()->lastName }}"
									autocomplete="family-name"
									class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
							</div>
							@error('lastName')
							<span class="text-sm text-red-500">{{ $message }}</span>
							@enderror
						</div>

						<div class="col-span-full">
							<label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
								address</label>
							<div class="mt-2">
								<input id="email" name="email" type="email" autocomplete="email"
									value="{{ auth()->user()->email }}"
									class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
							</div>
							@error('email')
							<span class="text-sm text-red-500">{{ $message }}</span>
							@enderror
						</div>

						<div class="col-span-full">
							<label for="password"
								class="block text-sm font-medium leading-6 text-gray-900">Password to Confirm Yourself again</label>
							<div class="mt-2">
								<input type="password" name="password" id="password" autocomplete="password"
									class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
							</div>
							@error('password')
							<span class="text-sm text-red-500">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</div>

				<div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
					<div class="col-span-full">
						<label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
						<div class="mt-2">
							<textarea id="bio" name="bio" rows="3"
								class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{ auth()->user()->bio }}</textarea>
						</div>
						<p class="mt-3 text-sm leading-6 text-gray-600">
							Write a few sentences about yourself.
						</p>
					</div>
					@error('bio')
					<span class="text-sm text-red-500">{{ $message }}</span>
					@enderror
				</div>
			</div>
		</div>

		<div class="flex items-center justify-end mt-6 gap-x-6">
			<button type="button" class="text-sm font-semibold leading-6 text-gray-900">
				Cancel
			</button>
			<button type="submit"
				class="px-3 py-2 text-sm font-semibold text-white bg-gray-600 rounded-md shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
				Save
			</button>
		</div>
	</form>
	<!-- /Profile Edit Form -->

</x-app-layout>

<script>
	const uploadAvatarButton = document.querySelector("#avatar");
	uploadAvatarButton.addEventListener("change", showAvatar);

	function showAvatar(event) {
		let image = document.getElementById("temp-photo");
		image.src = URL.createObjectURL(event.target.files[0]);
		image.classList.add('opacity-100');
	};
</script>