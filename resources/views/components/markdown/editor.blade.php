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
    </label>
    <markdown-toolbar for="{{ $field }}" class="space-x-2 my-2 block">
        <md-bold><x-misc.toolbar-button x-bind:disabled="mode == 'html'" x-bind:class="{'opacity-100': mode != 'html', 'opacity-50': mode == 'html'}">bold</x-misc.toolbar-button></md-bold>
        <md-header><x-misc.toolbar-button x-bind:disabled="mode == 'html'" x-bind:class="{'opacity-100': mode != 'html', 'opacity-50': mode == 'html'}">header</x-misc.toolbar-button></md-header>
        <md-italic><x-misc.toolbar-button x-bind:disabled="mode == 'html'" x-bind:class="{'opacity-100': mode != 'html', 'opacity-50': mode == 'html'}">italic</x-misc.toolbar-button></md-italic>
        <md-quote><x-misc.toolbar-button x-bind:disabled="mode == 'html'" x-bind:class="{'opacity-100': mode != 'html', 'opacity-50': mode == 'html'}">quote</x-misc.toolbar-button></md-quote>
        <md-code><x-misc.toolbar-button x-bind:disabled="mode == 'html'" x-bind:class="{'opacity-100': mode != 'html', 'opacity-50': mode == 'html'}">code</x-misc.toolbar-button></md-code>
        <md-link><x-misc.toolbar-button x-bind:disabled="mode == 'html'" x-bind:class="{'opacity-100': mode != 'html', 'opacity-50': mode == 'html'}">link</x-misc.toolbar-button></md-link>
        <md-unordered-list><x-misc.toolbar-button x-bind:disabled="mode == 'html'" x-bind:class="{'opacity-100': mode != 'html', 'opacity-50': mode == 'html'}">unordered-list</x-misc.toolbar-button></md-unordered-list>
        <md-ordered-list><x-misc.toolbar-button x-bind:disabled="mode == 'html'" x-bind:class="{'opacity-100': mode != 'html', 'opacity-50': mode == 'html'}">ordered-list</x-misc.toolbar-button></md-ordered-list>
        <x-misc.toolbar-button class="float-right" x-bind:disabled="{{ $markedField ? 'false' : 'true' }}" x-bind:class="{'opacity-100': {{ $markedField ? 'true' : 'false' }}, 'opacity-50': {{ $markedField ? 'false' : 'true' }}}" data-md-button wire:click="$emitUp('refresh')" x-on:click="mode = (mode == 'html' ? 'text' : 'html')" x-text="(mode != 'html' ? 'Preview' : 'Edit')"></x-misc.toolbar-button>
    </markdown-toolbar>
    <textarea x-show="mode == 'text'" id="{{ $field }}" wire:model.debounce.500ms="{{ $field }}" type="text" rows="12"
        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
        required></textarea>
    <div
        x-show="mode == 'html'"
        class="@if(! $markedField) hidden @endif mt-1 px-2 py-3 bg-white block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md h-64 max-w-full"
        id="marked{{ $field }}"
        >
        {!! $markedField !!}
        </div>
</div>

