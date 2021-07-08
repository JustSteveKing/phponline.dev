<div class="relative">
    <input
        type="search"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
        wire:model="query"
        placeholder="Search"
        autocomplete="off"
    />

    @if ($searching)
        <div class="bg-white origin-top-right absolute right-0 mt-2 w-full max-h-40 rounded-md ring-1 ring-black ring-opacity-5 overflow-y-scroll focus:outline-none z-50">
            <div class="py-1">
                @forelse ($results as $result)
                    <a
                        wire:click="selected({{ $result['id'] }})"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                    >
                        {{ $result[$searchKey] }}
                    </a>
                @empty
                    <a
                        wire:click="create"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                    >
                        Create <span class="text-gray-900 font-semibold">{{ $query }}</span>
                    </a>
                @endforelse
            </div>
        </div>
    @endif
</div>
