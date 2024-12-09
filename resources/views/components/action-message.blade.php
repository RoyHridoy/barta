@props(['on'])

<div
    x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => {
        clearTimeout(timeout);
        shown = true;
        timeout = setTimeout(() => { shown = false }, 2000);
    })"
    x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms
    style="display: none;"
    {{ $attributes->merge(['class' => 'text-sm text-gray-600 fixed z-50 px-4 py-2 text-white rounded right-5 top-5 bg-emerald-500']) }}
>
    {{ $slot->isEmpty() ? __('Saved.') : $slot }}
</div>
