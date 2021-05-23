<section class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
    <aside class="lg:col-start-1 lg:col-span-1">
        <livewire:autocomplete
            model="App\Models\Stream"
            search-key="author"
            emits="authorSelected"
            initialValue="{{ $query }}"
        />
    </aside>
    <main class="space-y-6 lg:col-start-2 lg:col-span-2">
        <ul class="w-full space-y-6">
            @forelse($streams as $stream)
            <li class="flex flex-col bg-white w-full mx-auto rounded-lg shadow-md hover:shadow-lg">
                <a
                    target="__blank"
                    rel="noopener nofollow"
                    href="{{ $stream['external_url'] }}"
                    class="flex items-center justify-between px-6 py-3 bg-gray-900 cursor-pointer"
                >
                    <span class="flex items-center">
                        <h4 class="flex flex-col mx-3 text-white">
                            <span class="font-semibold text-lg">{!! $stream['title'] !!}</span>
                            <span class="font-light text-sm">
                                - with {{ $stream['author'] }}
                            </span>
                        </h4>
                    </span>
                </a>
                <div class="py-4 px-6">
                    <a
                        title="Watch on YouTube"
                        target="__blank"
                        rel="noopener nofollow"
                        href="{{ $stream['external_url'] }}"
                        class="flex items-center mt-4 text-gray-700 cursor-pointer"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        <p class="px-2 text-sm truncate">
                            Watch on YouTube
                        </p>
                    </a>
                </div>
            </li>
            @empty
                <li>No results</li>
            @endforelse
        </ul>
    </main>
</section>
