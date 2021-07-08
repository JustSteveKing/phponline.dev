@props([
    'field',
    'markedField',
    'title'
])

<div
    class="py-3 px-6"
    x-data="{
        mode: 'text'
    }"
    >
    <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 flex flex-row justify-between items-center">
        <span>{{ $title }}</span>
        <button class="focus:ring-indigo-500 focus:border-indigo-500 border border-transparent" type="button" wire:click="$emitUp('refresh')" x-on:click="mode = (mode == 'html' ? 'text' : 'html')" x-text="(mode != 'html' ? 'Preview' : 'Edit')"></button>
    </label>
    <markdown-toolbar for="{{ $field }}" x-show="mode == 'text'" class="space-x-2 my-2 block">
        <md-bold><x-misc.toolbar-button>bold</x-misc.toolbar-button></md-bold>
        <md-header><x-misc.toolbar-button>header</x-misc.toolbar-button></md-header>
        <md-italic><x-misc.toolbar-button>italic</x-misc.toolbar-button></md-italic>
        <md-quote><x-misc.toolbar-button>quote</x-misc.toolbar-button></md-quote>
        <md-code><x-misc.toolbar-button>code</x-misc.toolbar-button></md-code>
        <md-link><x-misc.toolbar-button>link</x-misc.toolbar-button></md-link>
        <md-unordered-list><x-misc.toolbar-button>unordered-list</x-misc.toolbar-button></md-unordered-list>
        <md-ordered-list><x-misc.toolbar-button>ordered-list</x-misc.toolbar-button></md-ordered-list>
    </markdown-toolbar>
    <textarea x-show="mode == 'text'" id="{{ $field }}" wire:model.debounce.500ms="{{ $field }}" type="text" rows="12"
        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
        required></textarea>
    <div
        x-show="mode == 'html'"
        class="mt-1 p-2 bg-white block w-full shadow-sm sm:text-sm border-gray-300 rounded-md h-64 prose prose-xl max-w-full"
        >
        {!! $markedField !!}
        </div>
</div>
