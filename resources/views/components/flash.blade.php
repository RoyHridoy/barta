@props(['type' => 'success'])
<div
    class="p-2 font-bold text-center rounded {{ $type === 'success' ? 'text-teal-900 bg-teal-300': '' }} {{ $type === 'error' ? 'text-red-900 bg-red-300': '' }}">
    {{ session($type) }}
</div>