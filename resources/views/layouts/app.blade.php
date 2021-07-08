<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/default.min.css">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @stack('styles')

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>
        <script>
            hljs.highlightAll();
        </script>
    </head>
    <body class="font-sans antialiased">

        <div class="min-h-screen bg-gray-100">
            <x-site.navigation />

            <main class="pt-16 relative">
                <livewire:notification />

                {{ $slot }}
            </main>

            <x-site.footer />
        </div>

        @stack('modals')
        @stack('scripts')

        @livewireScripts
    </body>
</html>
