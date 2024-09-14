<x-app-layout>
    <form action="{{ route('password-change') }}" method="post" class="mt-20 space-y-6" novalidate>
        @csrf
        @method('PUT')
        
        <x-input name="currentPassword" type="password" placeholder="••••••••" label="Current Password" value="{{ old('currentPassword') }}" />

        <x-input name="password" type="password" placeholder="••••••••" label="New Password"/>

        <x-input name="password_confirmation" type="password" placeholder="••••••••" label="Retype New Password"/>

        <div>
            <x-button type="submit">Change Password</x-button>
        </div>
    </form>
</x-app-layout>