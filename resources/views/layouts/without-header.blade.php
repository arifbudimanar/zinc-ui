<x-page class="!bg-zinc-50 dark:!bg-zinc-900">
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    {{-- Toolbox --}}
    <x-navbar class="fixed top-0 z-30 flex items-center gap-1 right-4">
        <x-button variant="subtle" size="sm" icon="o-magnifying-glass" tooltip="{{ __('Search') }}"
            class="sm:hidden" />
        <x-button variant="filled" size="sm" icon="o-magnifying-glass" kbd="Ctrl+K"
            class="hidden sm:flex">{{ __('Search everything') }}</x-button>

        <x-separator variant="subtle" vertical class="hidden mx-2 my-2 sm:block" />

        <x-theme-switcher variant="header"
            x-on:keydown.alt.l.window="lightMode()"
            x-on:keydown.alt.m.window="darkMode()"
            x-on:keydown.alt.p.window="systemMode()" />
    </x-navbar>

    {{-- Main --}}
    <x-main container class="flex items-center justify-center">
        {{ $slot }}
    </x-main>
</x-page>
