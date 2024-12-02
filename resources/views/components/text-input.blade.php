@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6']) }}>
