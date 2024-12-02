<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black']) }}>
    {{ $slot }}
</button>
