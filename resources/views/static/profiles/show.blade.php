<x-app-layout>
    <x-site.header class="py-6 bg-gray-900 mb-12">
        <h2 class="text-2xl leading-9 font-semibold tracking-tight text-white md:text-3xl md:leading-10">
            <span class="block">
                {{ '@' . $user->username }}
            </span>
        </h2>

    </x-site.header>

    <div class="container mx-auto py-12">
        <ul>
            @forelse($user->feeds as $feed)
                <li>
                    <a
                        href="{{ route('static:profile:feeds:show', [
                            $user->username,
                            $feed->uuid
                        ]) }}"
                        class="inline-flex"
                    >
                        <x-icons.check-circle
                            class="h-4 w-4 text-{{ $feed->verified ? 'green' : 'gray' }}-500"
                        />
                        <span>
                            {{ $feed->title }}
                        </span>
                    </a>
                </li>
            @empty 
                <li>nooope</li>
            @endforelse
        </ul>
    </div>

    <div class="container mx-auto py-12">
        <ul class="space-y-4">
            @forelse ($user->podcasts as $podcast)
                <li>
                    <div class="flex bg-white w-full mx-auto rounded-lg shadow-md hover:shadow-lg h-56">
                        <div>
                            <img
                                class="w-full h-full object-fit object-center rounded hidden md:block bg-gray-900"
                                src="{{ $podcast->getImage() }}"
                                alt="{{ $podcast->title }}"
                            />
                        </div>
                        <div class="w-full p-8 flex flex-col items-center justify-center space-y-3">
                            <h3 class="text-2xl text-grey-darkest font-medium">
                                {{ $podcast->title }}
                            </h3>
                    
                            <a href="" class="flex items-center mt-4 text-gray-700 cursor-pointer">
                                <x-icons.link-external class="h-6 w-6" />
                                <p class="px-2 text-sm">
                                    {{ $podcast->external_url }}
                                </p>
                            </a>
                        </div>
                    </div>
                </li>
            @empty
                <li>No podcasts</li>
            @endforelse
        </ul>
    </div>


    <div class="container mx-auto py-12">
        <ul class="space-y-4">
            @forelse ($user->packages as $package)
                <li>
                    <x-packages.card
                        :package="$package"
                    />
                </li>
            @empty
                <li>No packages</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>