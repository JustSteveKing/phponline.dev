<x-app-layout>
    <x-site.header class="py-6 bg-gray-900 mb-12">
        <h2 class="text-2xl leading-9 font-semibold tracking-tight text-white md:text-3xl md:leading-10">
            <span class="block">
                Podcasts
            </span>
        </h2>
        <x-slot name="actions">
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <span class="ml-3 shadow-sm rounded-md">
                    @auth
                        <a
                            href=""
                            class="inline-flex items-center ps-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:bg-gray-50 focus:outline-none focus:shadow-outline-indigo focus:border-red-600 active:bg-gray-50 transition duration-150 ease-in-out"
                        >
                          Submit a podcast
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:bg-gray-50 focus:outline-none focus:shadow-outline-indigo focus:border-red-600 active:bg-gray-50 transition duration-150 ease-in-out"
                        >
                          Log in to submit
                        </a>
                    @endauth
              </span>
            </div>
        </x-slot>
    </x-site.header>

    <x-site.container class="max-w-screen-xl">
        <div>
            <livewire:podcasts.list-podcasts />
        </div>
    </x-site.container>
</x-app-layout>