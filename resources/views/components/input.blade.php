@props(['name', 'type' => 'text', 'placeholder' => '', 'label' => '', 'required' => true])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
    <div class="mt-2">
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" autocomplete="{{ $name }}"
            placeholder="{{ $placeholder }}" @required($required) {{ $attributes->merge() }}
            class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error($name) ring-red-300 @else ring-gray-300 @enderror" />
    </div>
    @error($name)
    <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>