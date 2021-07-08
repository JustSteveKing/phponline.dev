<x-site.container class="max-w-screen-xl">
    <div class="space-y-6">

        @if (session()->has('verified'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Heroicon name: solid/exclamation -->
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {!! session('verified') !!}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Your Feeds
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Add new feed sources to help inspire and teach the community.
                </p>
            </div>
            <div class="ml-4 mt-4 flex-shrink-0">
                <a href="{{ route('dashboard:feeds:create') }}" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit a new feed
                </a>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                @forelse($feeds as $feed)
                    <li>
                        <a href="{{ route('dashboard:feeds:show', $feed->uuid) }}" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-medium text-indigo-600 truncate">
                                        {{ $feed->title }}
                                    </h3>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p
                                            class="px-2 inline-flex text-md leading-5 font-semibold rounded-full {{ $feed->verified ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}"
                                        >
                                            {{ $feed->verified ? 'verified' : 'awaiting verification' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center text-md text-gray-500">
                                            <x-icons.lock-closed
                                                class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                            />
                                            Verification token: <span class="font-semibold text-gray-900">{{ $feed->verification_token }}</span>
                                        </p>
                                    </div>
                                    <div class="mt-2 flex items-center text-md text-gray-500 sm:mt-0">
                                        <x-icons.calendar
                                            class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                        />
                                        <p>
                                            Created:
                                            <time datetime="{{ $feed->created_at->toDateTimeString() }}">
                                                {{ $feed->created_at->diffForHumans() }}
                                            </time>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @empty
                    <li>
                        <x-site.empty>
                            <p>No feeds created yet, why not add some?</p>
                        </x-site.empty>
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
</x-site.container>