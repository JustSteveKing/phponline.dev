<x-site.container>
    <section class="mb-12">
        <div class="flex items-center justify-between">
            <h2 class="text-xl leading-5 tracking-tight font-semibold text-gray-900 sm:text-2xl sm:leading-10">
                Latest community feed items
            </h2>
        </div>
        <div class="mt-6 grid gap-16 border-t-2 border-gray-100 pt-3 grid-cols-1 lg:grid-cols-2 lg:gap-x-5 lg:gap-y-12">
            @foreach ($feedItems as $item)
                <x-feed-items.card
                    :key="$item->id"
                    :feed-item="$item"
                />
            @endforeach
        </div>
    </section>
</x-site.container>
