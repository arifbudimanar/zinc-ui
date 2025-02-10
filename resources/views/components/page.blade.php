<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('logos/brand-light.png') }}" rel="icon" media="(prefers-color-scheme: light)" />
    <link href="{{ asset('logos/brand-dark.png') }}" rel="icon" media="(prefers-color-scheme: dark)" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">

    @isset($head)
        {{ $head }}
    @endisset

    <script>
        setThemeClass = () => {
            const theme = localStorage.theme || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                'light');
            document.documentElement.classList.toggle('dark', theme === 'dark');
            document.documentElement.classList.toggle('light', theme === 'light');
        }

        setThemeClass();
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', setThemeClass);
    </script>

    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body {{ $attributes->class('bg-white dark:bg-zinc-800 antialiased min-h-screen') }}
    x-data="{
        isSidebarOpen: false,
        openSidebar() {
            this.isSidebarOpen = true;
        },
        toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen;
        },
        closeSidebar() {
            this.isSidebarOpen = false;
        },
    }" x-resize.document="$width >= 1024 && closeSidebar" data-page>

    {{ $slot }}

    @persist('toaster')
        <x-toaster />
    @endpersist

    {{-- @livewireScripts --}}
    @livewireScriptConfig
</body>

</html>
