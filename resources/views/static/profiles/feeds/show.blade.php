<x-app-layout>
    <x-site.header class="py-6 bg-gray-900 mb-12">
        <h2 class="text-2xl leading-9 font-semibold tracking-tight text-white md:text-3xl md:leading-10">
            <span class="block">
                {{ $feed->title }}
            </span>
        </h2>

    </x-site.header>

    <div class="container mx-auto py-6">
        <ul class="space-y-4">
            @forelse($feed->items as $item)
                <li class="bg-white rounded-lg shadow-md px-4 py-3">
                    <div class="flex justify-between items-center">
                        <span class="font-light text-gray-600">
                            {{ $item->published_at->format('jS \o\f F, Y') }}
                        </span>
                        <p class="px-2 py-1 bg-blue-600 text-gray-100 font-bold rounded hover:bg-gray-500">
                            {{ $item->author }}
                        </p>
                    </div>
                    <div class="mt-2">
                        <a class="text-2xl text-gray-700 font-bold hover:text-gray-600" href="#">
                            {{ $item->title }}
                        </a>
                        <div class="mt-2 text-gray-600">
                            {!! $item->description !!}
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <a
                            class="text-blue-600 hover:underline"
                            href="{{ $item->external_url }}?utm_source=phponline.dev#feeds"
                            target="__blank"
                            rel="noopener nofollow"
                        >
                            Visit Article
                        </a>
                    </div>
                </li>
            @empty
                <li>No items yet ...</li>
            @endforelse
        </ul>
    </div>

</x-app-layout>
