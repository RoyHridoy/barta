<x-app-layout>
	<!-- Profile Edit Form -->

	<form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data" novalidate>
		@csrf
		@method('PATCH')
		<div class="space-y-12">
			<div class="pb-12 border-b border-gray-900/10">
				@session('success')
					<x-flash type="success"/>
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
								<img class="object-cover w-12 h-12 rounded-full" id="photo" src="{{ asset("storage/".auth()->user()->avatar, ) }}" alt="{{ auth()->user()->fullName }}" />
							@else
							    <img class="w-12 h-12 text-gray-400 border border-gray-500 rounded-full" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->fullName }}" alt="{{ auth()->user()->fullName }}">
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
							<x-input name="firstName" value="{{ auth()->user()->firstName }}" label="First name"/>
						</div>

						<div class="sm:col-span-3">
							<x-input name="lastName" value="{{ auth()->user()->lastName }}" label="Last name"/>
						</div>

						<div class="col-span-full">
							<x-input name="email" type="email" value="{{ auth()->user()->email }}" label="Email Address"/>
						</div>

						<div class="col-span-full">
							<x-input name="password" type="password" label="Password to Confirm Yourself again"/>
						</div>
					</div>
				</div>

				<x-textarea name="bio" label="Bio" description="Write a few sentences about yourself.">{{ auth()->user()->bio }}</x-textarea>
			</div>
		</div>

		<div class="flex items-center justify-end w-1/2 mt-6 ml-[50%] gap-x-6">
			<x-button type="reset" :secondary="true">Cancel</x-button>
			<x-button type="submit">Update</x-button>
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
