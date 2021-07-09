<nav x-data="{ open: false }" class="flex-shrink-0 bg-white shadow-lg fixed w-screen z-40">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
        <div class="relative flex items-center justify-between h-16">

            <!-- Logo section -->
            <div class="flex items-center px-2 lg:px-0 w-1/5">
                <a href="{{ route('static:home') }}" class="flex-shrink-0" aria-label="PHP Online Logo">
                    <x-site.logo-text class="hidden lg:block h-8 w-auto" alt="PHP Online Logo" />
                    <x-site.logo-image class="block lg:hidden h-8 w-auto" alt="PHP Online Logo" />
                </a>
            </div>

            <!-- Search section -->
            <div class="flex justify-center lg:justify-end w-3/5 lg:w-2/5">
                <div class="w-full px-2 lg:px-6">
                    <label for="search" class="sr-only">Search projects</label>
                    <div class="relative text-gray-300 focus-within:text-gray-400">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input id="search" class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-gray-200 bg-opacity-25 text-gray-700 placeholder-gray-500 focus:outline-none focus:bg-white focus:placeholder-gray-400 focus:text-gray-900 sm:text-sm transition duration-150 ease-in-out" placeholder="Search ..." type="search" autocomplete="off">
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex lg:hidden">
                <!-- Mobile menu button -->
                <button @click="open = !open" @click.away="open = false" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-400 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 focus:text-gray-400 transition duration-150 ease-in-out" x-bind:aria-label="open ? 'Close main menu' : 'Main menu'" aria-label="Main menu" x-bind:aria-expanded="open">
                    <!-- Icon when menu is closed. -->
                    <svg x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'hidden': open, 'block': !open }" class="h-6 w-6 block" x-description="Heroicon name: menu-alt-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"></path>
                    </svg>
                    <!-- Icon when menu is open. -->
                    <svg x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'hidden': !open, 'block': open }" class="h-6 w-6 hidden" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Links section -->
            <div class="hidden lg:block w-2/5">
                <div class="flex items-center justify-end">
                    <div class="flex">
                        @foreach(\App\Services\Menu\MenuLoader::main() as $item)
                            <a
                                title="{{ $item['title'] }}"
                                href="{{ $item['link'] }}"
                                class="px-3 py-2 rounded-md text-sm leading-5 font-{{ request()->routeIs($item['pattern']) ? 'bold' : 'medium' }} text-{{ request()->routeIs($item['pattern']) ? 'gray-900' : 'gray-500' }} hover:text-gray-400 focus:outline-none focus:text-gray-400 hover:bg-gray-50 focus:bg-gray-50 transition duration-150 ease-in-out"
                            >
                                {{ $item['name'] }}
                            </a>
                        @endforeach
                    </div>
                    @auth
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('dashboard:index') }}">
                                    {{ __('Dashboard') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <x-jet-dropdown-link href="{{ route('dashboard:packages:index') }}">
                                    {{ __('Your Packages') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('dashboard:articles:index') }}">
                                    {{ __('Your Articles') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('dashboard:feeds:index') }}">
                                    {{ __('Your Feeds') }}
                                </x-jet-dropdown-link>

                                {{-- <x-jet-dropdown-link href="{{ route('dashboard:podcasts:index') }}">
                                    {{ __('Your Podcasts') }}
                                </x-jet-dropdown-link> --}}

                                {{-- <x-jet-dropdown-link href="{{ route('dashboard:links') }}">
                                    {{ __('Your Links') }}
                                </x-jet-dropdown-link> --}}

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())

                                    <div class="border-t border-gray-100"></div>

                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="block px-4 py-2 text-xs text-gray-500">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-500">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach

                                    <div class="border-t border-gray-100"></div>
                            @endif

                            <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                        {{ __('Logout') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    @else
                        <div class="flex h-full">
                            <div class="hidden sm:-my-px sm:ml-6 sm:flex">
                                <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm leading-5 font-medium text-{{ request()->routeIs('login') ? 'gray-900' : 'gray-500' }} hover:text-gray-400 focus:outline-none focus:text-gray-400 focus:bg-gray-50 transition duration-150 ease-in-out">
                                    Sign in
                                </a>
                                <a href="{{ route('register') }}" class="px-3 py-2 rounded-md text-sm leading-5 font-medium text-{{ request()->routeIs('register') ? 'gray-900' : 'gray-500' }} hover:text-gray-400 focus:outline-none focus:text-gray-400 focus:bg-gray-50 transition duration-150 ease-in-out">
                                    Sign up
                                </a>
                            </div>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>

    <div x-description="Mobile menu, toggle classes based on menu state." x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'block': open, 'hidden': !open }" class="lg:hidden hidden">
        <div class="px-2 pt-2 pb-3">
            @foreach(\App\Services\Menu\MenuLoader::main() as $item)
                <a
                    title="{{ $item['title'] }}"
                    href="{{ $item['link'] }}"
                    {{ request()->routeIs($item['pattern']) ? 'white' : 'indigo-200' }}
                    class="block px-3 py-2 rounded-md text-base font-{{ request()->routeIs($item['pattern']) ? 'bold' : 'medium' }} text-{{ request()->routeIs($item['pattern']) ? 'gray-900' : 'gray-400' }} hover:text-gray-400 hover:bg-gray-50 focus:outline-none focus:text-gray-400 focus:bg-gray-50 transition duration-150 ease-in-out"
                >
                    {{ $item['name'] }}
                </a>
            @endforeach
        </div>
        <div class="pt-4 pb-3 border-t border-gray-800">
            <div class="px-2">
                <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-{{ request()->routeIs('register') ? 'bold' : 'medium' }} text-{{ request()->routeIs('register') ? 'gray-900' : 'gray-400' }} hover:text-gray-400 hover:bg-gray-50 focus:outline-none focus:text-gray-400 focus:bg-gray-50 transition duration-150 ease-in-out">
                    Sign in
                </a>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-{{ request()->routeIs('login') ? 'bold' : 'medium' }} text-{{ request()->routeIs('login') ? 'gray-900' : 'gray-400' }} hover:text-gray-400 hover:bg-gray-50 focus:outline-none focus:text-gray-400 focus:bg-gray-50 transition duration-150 ease-in-out">
                    Sign up
                </a>
            </div>
        </div>
    </div>
</nav>
