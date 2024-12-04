<x-app-layout>
    <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">

        {{-- Create Post --}}
        <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <livewire:PostCreate />
        </div>

        {{-- All Posts --}}
        <section class="space-y-8">
            <livewire:PostIndex />
        </section>
    </div>
</x-app-layout>
