<x-page class="!bg-zinc-50 dark:!bg-zinc-900">
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }}
        </title>
    </x-slot:head>

    {{-- Toolbox --}}
    <x-navbar class="fixed top-0 z-30 flex items-center gap-1 right-4">
        <x-theme-switcher variant="header" x-on:keydown.alt.l.window="lightMode()" x-on:keydown.alt.m.window="darkMode()"
            x-on:keydown.alt.p.window="systemMode()" />
    </x-navbar>

    {{-- Main --}}
    <x-main container class="flex items-center justify-center">
        <div class="flex flex-col justify-center max-w-sm">
            <x-heading size="xl" class="font-semibold text-center !text-7xl">
                @yield('code')
            </x-heading>
            <x-subheading size="xl" class="text-center">
                @yield('message')
            </x-subheading>
            <x-subheading size="lg" class="text-center">
                @yield('description')
            </x-subheading>
        </div>
    </x-main>
</x-page>
