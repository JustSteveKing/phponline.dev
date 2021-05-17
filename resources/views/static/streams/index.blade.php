<x-app-layout>
    <x-site.header class="py-6 bg-gray-900 mb-12">
        <h2 class="text-2xl leading-9 font-semibold tracking-tight text-white md:text-3xl md:leading-10">
            <span class="block">
                Streams powered by larastreamers.com
            </span>
        </h2>
    </x-site.header>
    <x-site.container class="max-w-screen-xl">
        <livewire:streams.streams-list />
    </x-site.container>
</x-app-layout>