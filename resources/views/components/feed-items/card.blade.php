<div class="flex flex-col bg-white w-full mx-auto rounded-lg shadow-md hover:shadow-lg">
    <a href="{{ url($feedItem->external_url ?? $feedItem->feed->url) }}" class="flex items-center justify-between px-6 py-3 bg-gray-900 cursor-pointer">
        <span class="flex items-center">
            <x-icons.rss class="h-6 w-6 text-white fill-current" />
            <h3 class="mx-3 text-white font-semibold text-lg">
                {{ $feedItem->title }}
            </h3>
        </span>
    </a>
    <div class="py-4 px-6">
        <div class="py-2 text-lg text-gray-700">
            {!! $feedItem->description !!}
        </div>
        <a href="{{ url($feedItem->external_url ?? $feedItem->feed->url) }}" class="flex items-center mt-4 text-gray-700 cursor-pointer">
            <x-icons.link-external class="h-6 w-6" />
            <p class="px-2 text-sm truncate">
                {{ url($feedItem->external_url ?? $feedItem->feed->url) }}
            </p>
        </a>
    </div>
</div>
