<x-app-layout>
    <div class="flex items-center justify-between bg-gray-900 mb-12 shadow-inner">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:flex lg:items-center lg:justify-between py-12 lg:py-0">
            <div>
                <h2 class="text-3xl leading-9 font-semibold tracking-tight text-white md:text-4xl md:leading-10">
                    <span class="block">Welcome to PHP Online</span>
                    <span class="block text-lg text-medium md:text-xl text-white">Your go to place for learning and pushing your PHP career forward</span>
                </h2>
            </div>
            <div class="-mt-10 -mb-28 lg:block hidden">
                <x-illustrations.working class="h-96" />
            </div>
        </div>
    </div>

    <livewire:articles.latest-articles />

    <livewire:packages.latest-packages />

    <livewire:feeds.latest-items />

{{--    <livewire:podcasts.latest-podcasts />--}}

</x-app-layout>
