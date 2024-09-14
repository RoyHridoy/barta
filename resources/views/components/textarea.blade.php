@props(['name', 'label' => '', 'description' => ''])
<div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
    <div class="col-span-full">
        <label for="{{ $name }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
        <div class="mt-2">
            <textarea id="{{ $name }}" name="{{ $name }}" rows="3"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{ $slot }}</textarea>
        </div>
        <p class="mt-3 text-sm leading-6 text-gray-600">
            {{ $description }}
        </p>
    </div>
    @error('{{ $name }}')
    <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>