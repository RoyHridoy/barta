@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'border-gray-800 text-gray-900 font-semibold", Default: "border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-800'
            : 'inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-600 border-b-2 border-transparent hover:border-gray-300 hover:text-gray-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
