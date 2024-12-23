<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithFileUploads;

    #[Validate(['image', 'nullable', 'max:500'])]
    public $tempPhoto;

    public string $firstName = '';
    public string $lastName = '';
    public string $username = '';
    public string $email = '';
    public $photo;
    public ?string $bio = '';
    public string $current_password = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->firstName = Auth::user()->firstName;
        $this->lastName = Auth::user()->lastName;
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
        $this->photo = Auth::user()->photo;
        $this->bio = Auth::user()->bio;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', Rule::unique(User::class)->ignore($user->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'bio' => ['string', 'nullable'],
            'current_password' => ['required', 'current_password'],
        ]);

        if ($this->tempPhoto) {
            if ($this->photo) {
                Storage::disk('public')->delete($this->photo);
            }
            $this->photo = $this->tempPhoto->storePublicly('users', 'public');
        }

        $user->fill($validated + ['photo' => $this->photo]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->reset('current_password');

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('home', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form
        wire:submit="updateProfileInformation"
        class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6"
    >
        <div class="col-span-full">
            <label class="block text-sm font-medium leading-6 text-gray-900">Avatar</label>
            <div class="relative mt-2 flex items-center gap-x-3">
                <input
                    id="avatar"
                    class="hidden"
                    wire:model="tempPhoto"
                    type="file"
                    name="avatar"
                />
                @if ($this->tempPhoto)
                    <img
                        src="{{ $tempPhoto->temporaryUrl() }}"
                        class="size-12 rounded-full"
                    >
                @else
                    <img
                        src="{{ auth()->user()->avatar }}"
                        class="size-12 rounded-full"
                        alt=""
                    >
                @endif
                <label for="avatar">
                    <div
                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Change
                    </div>
                </label>

            </div>
            <p class="mt-1 text-sm text-slate-400">* image size must be under 500kb</p>
            @error('tempPhoto')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <x-input-label
                for="firstName"
                :value="__('First Name')"
            />
            <x-text-input
                id="firstName"
                wire:model="firstName"
                name="firstName"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="firstName"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('firstName')"
            />
        </div>

        <div class="sm:col-span-3">
            <x-input-label
                for="lastName"
                :value="__('Last Name')"
            />
            <x-text-input
                id="lastName"
                wire:model="lastName"
                name="lastName"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="lastName"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('lastName')"
            />
        </div>

        <div class="col-span-full">
            <x-input-label
                for="username"
                :value="__('Username')"
            />
            <x-text-input
                id="username"
                wire:model="username"
                name="username"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('username')"
            />
        </div>

        <div class="col-span-full">
            <x-input-label
                for="email"
                :value="__('Email Address')"
            />
            <x-text-input
                id="email"
                wire:model="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                required
                autocomplete="username"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button
                            wire:click.prevent="sendVerification"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="col-span-full">
            <label
                for="bio"
                class="block text-sm font-medium leading-6 text-gray-900"
            >Bio</label>
            <div class="mt-2">
                <textarea
                    id="bio"
                    name="bio"
                    rows="3"
                    wire:model="bio"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6"
                >
                </textarea>
            </div>
            <p class="mt-1 text-sm leading-6 text-gray-600">
                Write a few sentences about yourself.
            </p>
        </div>

        <div class="col-span-full">
            <x-input-label
                for="password"
                :value="__('Password')"
            />
            <x-text-input
                id="password"
                wire:model="current_password"
                name="password"
                type="password"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="password"
                placeholder="••••••••"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('current_password')"
            />
        </div>

        <div class="col-span-full flex items-center gap-4">
            <x-primary-button wire:loading.attr="disabled">{{ __('Update') }}</x-primary-button>

            <x-action-message on="profile-updated">
                {{ __('Profile Updated.') }}
            </x-action-message>
        </div>
    </form>
</section>
