<x-app-layout>
    @session('success')
        <x-flash type="success"/>
    @endsession
    <x-article :post="$post" :postDetails="true"/>
</x-app-layout>
