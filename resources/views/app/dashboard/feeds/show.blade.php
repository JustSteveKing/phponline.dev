<x-app-layout>
    <x-site.header class="py-6 bg-gray-900 mb-12">
        <h2 class="text-2xl leading-9 font-semibold tracking-tight text-white md:text-3xl md:leading-10">
            Manage: {{ $feed->title }} feed
        </h2>

        <x-slot name="actions">
            <livewire:feeds.check-meta-button
                :feed="$feed"
            />
        </x-slot>
    </x-site.header>
    <x-site.container class="mb-12">
        <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-6">

            <section class="space-y-6 lg:col-start-1 lg:col-span-4">
                <div>
                    <div class="bg-white shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 class="text-xl leading-6 font-medium text-gray-900">
                                Feed Information
                            </h2>
                            <p class="mt-1 max-w-2xl text-lg text-gray-500">
                                Below are the details from your feed.
                            </p>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                @foreach ($feed->meta as $type => $content)
                                    <div class="sm:col-span-1">
                                        <dt class="text-md font-medium text-gray-500">
                                            {{ $type }}
                                        </dt>
                                        <dd class="mt-1 text-md text-gray-900">
                                            {{ $content }}
                                        </dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    </div>
                </div>
            </section>

            <aside class="lg:col-start-5 lg:col-span-3">
                <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Verification Instructions
                    </h2>
                    <div
                        class="mt-6"
                    >
                        <div class="text-lg font-normal space-y-2">
                            <p>Add a meta tag to your website:</p>
                            <p>Type: <span class="font-semibold">{{ $key }}</span></p>
                            <p>Content: <span class="font-semibold">{{ $feed->verification_token }}</span></p>
                            
                            <pre>
                                <code class="language-html">{{ $snippet }}</code>
                            </pre>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </x-site.container>
</x-app-layout>