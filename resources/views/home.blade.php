<x-app-layout>
    <div class="py-9">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Create Post --}}
            <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <livewire:PostCreate />
            </div>

            {{-- All Posts --}}
            <section class="space-y-8">
                <livewire:PostIndex />
            </section>
        </div>
    </div>
</x-app-layout>
