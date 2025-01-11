<x-page>
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    {{-- Desktop navigation --}}
    <x-header container sticky class="border-b bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-bars-2" x-on:click="openSidebar" class="-ml-3 lg:hidden" />
        <x-brand class="px-2 rounded-lg lg:-ml-2 lg:mr-4" />
        <x-navbar class="-mb-px max-lg:hidden">
            <x-navbar.item wire:navigate href="/" active icon="o-home">{{ __('Home') }}</x-navbar.item>
            <x-navbar.item icon="o-inbox" badge="10">{{ __('Inbox') }}</x-navbar.item>
            <x-navbar.item icon="o-document-text">{{ __('Documents') }}</x-navbar.item>
            <x-navbar.item icon="o-calendar">{{ __('Calendar') }}</x-navbar.item>
            <x-separator variant="subtle" vertical class="mx-1 my-2" />
            <x-dropdown position="bottom-start">
                <x-navbar.item>
                    <x-slot:iconTrailing>
                        <x-icon name="o-chevron-down" x-show="!isDropdownOpen" class="shrink-0 size-5" />
                        <x-icon name="o-chevron-up" x-show="isDropdownOpen" x-cloak class="shrink-0 size-5" />
                    </x-slot:iconTrailing>
                    {{ __('Favorites') }}
                </x-navbar.item>
                <x-navmenu>
                    <x-navmenu.item>{{ __('Marketing site') }}</x-navmenu.item>
                    <x-navmenu.item>{{ __('Android app') }}</x-navmenu.item>
                    <x-navmenu.item>{{ __('Brand guidlines') }}</x-navmenu.item>
                </x-navmenu>
            </x-dropdown>
        </x-navbar>
        <x-spacer />
        <x-navbar class="mr-2">
            <x-button variant="subtle" size="sm" icon="o-magnifying-glass" tooltip="{{ __('Search') }}"
                class="sm:hidden lg:flex xl:hidden" />
            <x-button variant="filled" size="sm" icon="o-magnifying-glass" kbd="Ctrl+K"
                class="hidden sm:flex lg:hidden xl:flex">{{ __('Search everything') }}</x-button>
            <x-separator variant="subtle" vertical class="hidden mx-2 my-2 sm:block lg:hidden xl:block" />
            <x-theme-switcher variant="header" class="hidden lg:block" />
            <x-button variant="subtle" size="sm" icon="o-bell" tooltip="{{ __('Notifications') }}" />
        </x-navbar>
        {{-- Auth --}}
        <x-dropdown position="bottom-end">
            <x-profile avatar="https://ui-avatars.com/api/?name=Jhon+Doe&color=27272a&background=00000000&format=svg"
                class="-mr-3" />
            <x-navmenu>
                <div class="px-2 py-1.5 max-w-48">
                    <x-heading class="truncate !mb-0">Jhon Doe</x-heading>
                    <x-subheading class="text-xs truncate">jhondoe@gmail.com</x-subheading>
                </div>
                <x-navmenu.separator />
                <x-navmenu.item icon="o-rectangle-stack">{{ __('Dashboard') }}</x-navmenu.item>
                <x-navmenu.item icon="o-user-circle">{{ __('Account') }}</x-navmenu.item>
                <x-navmenu.item icon="o-cog-8-tooth">{{ __('Settings') }}</x-navmenu.item>
                <x-navmenu.separator />
                <x-navmenu.item icon="l-log-out">{{ __('Logout') }}</x-navmenu.item>
            </x-navmenu>
        </x-dropdown>
        {{-- Guest --}}
        {{-- <x-button variant="outline" size="sm">{{ __('Login') }}</x-button> --}}
    </x-header>

    {{-- Mobile navigation --}}
    <x-sidebar sticky transition x-show="isSidebarOpen" x-trap.inert.noscroll="isSidebarOpen" x-cloak
        x-on:click.outside="closeSidebar" x-on:keydown.escape="closeSidebar"
        class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-x-mark" x-on:click="closeSidebar" />
        <x-brand class="px-2 !gap-2.5 rounded-lg" />
        <x-navlist variant="outline">
            <x-navlist.item wire:navigate href="/" active icon="o-home">{{ __('Home') }}</x-navlist.item>
            <x-navlist.item icon="o-inbox" badge="10">{{ __('Inbox') }}</x-navlist.item>
            <x-navlist.item icon="o-document-text">{{ __('Documents') }}</x-navlist.item>
            <x-navlist.item icon="o-calendar">{{ __('Calendar') }}</x-navlist.item>
            <x-navlist.group heading="{{ __('Favorites') }}" class="mt-4">
                <x-navlist.item>{{ __('Marketing site') }}</x-navlist.item>
                <x-navlist.item>{{ __('Android app') }}</x-navlist.item>
                <x-navlist.item>{{ __('Brand guiddlines') }}</x-navlist.item>
            </x-navlist.group>
        </x-navlist>
        <x-spacer />
        <x-navlist>
            <x-theme-switcher variant="sidebar" x-on:keydown.alt.l.window="lightMode()"
                x-on:keydown.alt.m.window="darkMode()" x-on:keydown.alt.p.window="systemMode()" />
        </x-navlist>
    </x-sidebar>

    {{-- Overlay sidebar open --}}
    <x-overlay x-show="isSidebarOpen" x-cloak x-on:click="closeSidebar" class="lg:hidden" />

    {{-- Main --}}
    <x-main container class="max-w-7xl">
        {{ $slot }}
    </x-main>

    {{-- Footer --}}
    <x-container class="[grid-area:footer]">
        <x-separator variant="subtle" class="mb-8" />
        <div class="grid grid-cols-2 gap-6 lg:gap-8 sm:grid-cols-3 lg:grid-cols-6">
            <div class="col-span-full lg:col-span-3">
                <x-brand />
                <x-subheading>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos quod vitae deserunt inventore
                    consequatur pariatur!
                </x-subheading>
            </div>
            <div class="space-y-2 text-sm lg:mt-2">
                <x-subheading class="uppercase">{{ __('Resources') }}</x-subheading>
                <x-link href="https://laravel.com" target="_blank" class="flex w-full">{{ __('Laravel') }}</x-link>
                <x-link href="https://livewire.laravel.com" target="_blank"
                    class="flex w-full">{{ __('Livewire') }}</x-link>
                <x-link href="https://alpinejs.dev/" target="_blank" class="flex w-full">{{ __('Alpine Js') }}</x-link>
                <x-link href="https://tailwindcss.com/" target="_blank" class="flex w-full">
                    {{ __('Tailwind CSS') }}</x-link>
            </div>
            <div class="space-y-2 text-sm lg:mt-2">
                <x-subheading class="uppercase">{{ __('Legal') }}</x-subheading>
                <x-link wire:navigate href="/terms-of-service"
                    class="flex w-full">{{ __('Terms of Service') }}</x-link>
                <x-link wire:navigate href="/privacy-policy" class="flex w-full">{{ __('Privacy Policy') }}</x-link>
            </div>
            <div class="space-y-2 text-sm lg:mt-2">
                <x-subheading class="uppercase">{{ __('Socials') }}</x-subheading>
                <x-link target="_blank" class="flex w-full">{{ __('Github') }}</x-link>
                <x-link target="_blank" class="flex w-full">{{ __('Discord') }}</x-link>
            </div>
        </div>
        <div class="flex flex-col justify-start gap-2 py-8 lg:items-center sm:flex-row sm:justify-center">
            <x-subheading>
                Copyright © {{ now()->year }} {{ config('app.name') }}
            </x-subheading>
            <span class="hidden sm:inline-block">·</span>
            <x-subheading>
                {{ __('Built by') }}
                <x-link variant="subtle" href="https://github.com/arifbudimanar" target="_blank">
                    Arif Budiman Arrosyid
                </x-link>
            </x-subheading>
        </div>
    </x-container>
</x-page>
