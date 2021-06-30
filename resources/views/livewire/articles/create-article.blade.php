<section class="pb-6">
    <form class="w-full rounded-lg shadow-lg" wire:submit.prevent="submit">
        <div class="py-3 px-6">
            <label for="title" class="block text-sm font-medium text-gray-700">
                Article Title
            </label>
            <input id="title" wire:model="title" type="text"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                placeholder="Enter your article title ..." required autofocus />
        </div>
        <div class="py-3 px-6">
            <label for="summary" class="block text-sm font-medium text-gray-700">
                Article Summary
            </label>
            <textarea id="summary" wire:model="summary" type="text" rows="6"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                required></textarea>
        </div>
        <div class="py-3 px-6">
            <x-jet-label for="level" value="{{ __('Select a difficulty') }}" />
            <select
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                name="level" id="level" wire:model="level">
                <option value>Please select ...</option>
                @foreach ($levels as $level)
                    <option value="{{ $level }}">
                        {{ ucwords($level) }}
                    </option>
                @endforeach
            </select>
            <x-jet-input-error for="feed" class="mt-2" />
        </div>
        <div
            class="py-3 px-6"
            x-data="{
                mode: 'text'
            }"
            >
            <label for="body" class="block text-sm font-medium text-gray-700 flex flex-row justify-between items-center">
                <span>Article Body</span>
                <button class="focus:ring-indigo-500 focus:border-indigo-500 border border-transparent" type="button" wire:click="parseMarkdown()" x-on:click="mode = (mode == 'html' ? 'text' : 'html')" x-text="(mode != 'html' ? 'Preview' : 'Edit')"></button>
            </label>
            <markdown-toolbar for="body" x-show="mode == 'text'" class="space-x-2 my-2 block">
                <md-bold><x-misc.toolbar-button>bold</x-misc.toolbar-button></md-bold>
                <md-header><x-misc.toolbar-button>header</x-misc.toolbar-button></md-header>
                <md-italic><x-misc.toolbar-button>italic</x-misc.toolbar-button></md-italic>
                <md-quote><x-misc.toolbar-button>quote</x-misc.toolbar-button></md-quote>
                <md-code><x-misc.toolbar-button>code</x-misc.toolbar-button></md-code>
                <md-link><x-misc.toolbar-button>link</x-misc.toolbar-button></md-link>
                <md-unordered-list><x-misc.toolbar-button>unordered-list</x-misc.toolbar-button></md-unordered-list>
                <md-ordered-list><x-misc.toolbar-button>ordered-list</x-misc.toolbar-button></md-ordered-list>
            </markdown-toolbar>
            <textarea x-show="mode == 'text'" id="body" wire:model.debounce.500ms="body" type="text" rows="12"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                required></textarea>
            <div
                x-show="mode == 'html'"
                class="mt-1 p-2 bg-white block w-full shadow-sm sm:text-sm border-gray-300 rounded-md h-64 prose prose-xl max-w-full"
                >
                {!! $markedBody !!}
                </div>
        </div>
        <div class="py-3 px-6">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button wire:loading.attr="disabled" wire:target="body">
                {{ __('Save') }}
            </x-jet-button>
        </div>
    </form>
</section>

@push('scripts')
<script type="module" src="https://cdn.jsdelivr.net/npm/@github/markdown-toolbar-element@1.4.0/dist/index.min.js"></script>
<script type="module" src="https://unpkg.com/@github/file-attachment-element@1.x/dist/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/mdhl@0.0.6/dist/mdhl.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdhl@0.0.6/mdhl.css">
@endpush
