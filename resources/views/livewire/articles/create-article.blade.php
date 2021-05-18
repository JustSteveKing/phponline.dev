<section class="pb-6">
    <form class="w-full rounded-lg shadow-lg" wire:submit.prevent="submit">
        <div class="py-3 px-6">
            <label for="title" class="block text-sm font-medium text-gray-700">
                Article Title
            </label>
            <input
                id="title"
                wire:model="title"
                type="text"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                placeholder="Enter your article title ..."
                required
                autofocus
            />
        </div>
        <div class="py-3 px-6">
            <label for="body" class="block text-sm font-medium text-gray-700">
                Article Body
            </label>
            <div>
                <div class="sm:hidden">
                    <label for="tabs" class="sr-only">Select a tab</label>
                    <select id="tabs" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                        <option selected>Write</option>
                        <option>Preview</option>
                    </select>
                </div>
                <div class="hidden sm:block">
                    <nav class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200" aria-label="Tabs">
                        <a href="#" class="text-gray-900 rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10" aria-current="page">
                        <span>Write</span>
                        <span aria-hidden="true" class="bg-indigo-500 absolute inset-x-0 bottom-0 h-0.5"></span>
                        </a>

                        <a href="#" class="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10">
                        <span>Preview</span>
                        <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                        </a>
                    </nav>
                </div>
            </div>
            <textarea
                id="body"
                wire:model="body"
                type="text"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                required
            ></textarea>
        </div>
    </form>
</section>
