<textarea x-data="{
    resize() {
        $el.style.height = '0px';
        $el.style.height = $el.scrollHeight + 'px'
    }
}" x-init="resize()" @input="resize()" type="text"
    {{ $attributes->merge(['class' => 'border-sm ring-offset-background mb-1 flex h-auto min-h-[40px] w-full rounded-lg border border-neutral-300 bg-gray-100 px-3 py-2 text-sm text-gray-900 placeholder:text-neutral-400 focus:border-neutral-300 focus:bg-white focus:outline-none focus:ring-1 focus:ring-neutral-400 focus:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50']) }}></textarea>
