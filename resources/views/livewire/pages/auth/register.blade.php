<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $firstName = '';
    public string $lastName = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-slot name="title">Create a new account</x-slot>
    <form wire:submit="register" class="space-y-4">
        <!-- First Name -->
        <div>
            <x-input-label for="firstName" :value="__('First Name')" />

            <x-text-input id="firstName" wire:model="firstName" class="block w-full mt-1" type="text" name="firstName"
                required autofocus autocomplete="firstName" placeholder="hridoy" />

            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="lastName" :value="__('Last Name')" />

            <x-text-input id="lastName" wire:model="lastName" class="block w-full mt-1" type="text" name="lastName"
                required autofocus autocomplete="lastName" placeholder="roy" />

            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />

            <x-text-input id="username" wire:model="username" class="block w-full mt-1" type="text" name="username"
                required autofocus autocomplete="username" placeholder="royhridoy" />

            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />

            <x-text-input id="email" wire:model="email" class="block w-full mt-1" type="email" name="email"
                required autocomplete="username" placeholder="hridoy.roy@test.com" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" wire:model="password" class="block w-full mt-1" type="password" name="password"
                required autocomplete="new-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" wire:model="password_confirmation" class="block w-full mt-1"
                type="password" name="password_confirmation" required autocomplete="new-password"
                placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button>
            {{ __('Register') }}
        </x-primary-button>
    </form>
    <p class="text-sm text-center text-gray-500 mt-7">
        {{ __('Already a member?') }}
        <a href="{{ route('login') }}" wire:navigate class="font-semibold leading-6 text-black hover:text-black">Sign
            In</a>
    </p>
</div>
