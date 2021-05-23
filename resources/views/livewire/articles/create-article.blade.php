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
        <div class="py-3 px-6">
            <label for="body" class="block text-sm font-medium text-gray-700">
                Article Body
            </label>
            <textarea id="body" wire:model="body" type="text" rows="12"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                required></textarea>
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
