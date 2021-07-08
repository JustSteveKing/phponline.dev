<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900">
                    Add a new Feed
                </h3>

                <p class="mt-1 text-sm text-gray-600">
                    You will need to verify ownership of any feeds you add.
                </p>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">

            <form wire:submit.prevent="submitFeed">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="title" value="{{ __('Feed Title') }}" />
                            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" autocomplete="off" />
                            <x-jet-input-error for="title" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="url" value="{{ __('Website URL') }}" />
                            <x-jet-input id="url" type="text" class="mt-1 block w-full" wire:model.defer="url" autocomplete="off" />
                            <x-jet-input-error for="url" class="mt-2" />
                            <p class="mt-2 text-sm text-gray-500">
                                We will autodetect if you have a feed available.
                            </p>
                        </div>
                    </div>
                </div>

                @if ($checked)
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="feed" value="{{ __('Select a Feed') }}" />
                                <select
                                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                    name="feed"
                                    id="feed"
                                    wire:model.defer="feed"
                                >
                                    <option value>Please select a feed ...</option>
                                    @foreach ($feeds as $feed)
                                        <option value="{{ $feed['type'] }}">
                                            {{ strtoupper($feed['type']) }} - {{ $feed['href'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="feed" class="mt-2" />
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    @if ($checked)
                        <x-jet-action-message class="mr-3" on="saved">
                            {{ __('Saved.') }}
                        </x-jet-action-message>
                
                        <x-jet-button wire:loading.attr="disabled" wire:target="url">
                            {{ __('Save') }}
                        </x-jet-button>
                    @else
                        <button wire:click.prevent="checkURL" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" wire:loading.attr="disabled" wire:target="title">
                            verify
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>