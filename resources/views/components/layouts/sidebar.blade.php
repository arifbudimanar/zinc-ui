<x-page>
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    {{-- Header --}}
    <x-header sticky class="border-b lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-bars-2" x-on:click="openSidebar" class="-ml-3 lg:hidden" />

        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-light.png') }}" name="{{ config('app.name') }}" class="flex px-2 rounded-lg dark:hidden lg:-ml-2 lg:mr-4" />
        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-dark.png') }}" name="{{ config('app.name') }}" class="hidden px-2 rounded-lg dark:flex lg:-ml-2 lg:mr-4" />

        <x-spacer />

        <x-navbar class="mr-2">
            <x-button variant="subtle" size="sm" icon="o-magnifying-glass" tooltip="{{ __('Search') }}"
                class="sm:hidden lg:flex xl:hidden" />
            <x-button variant="filled" size="sm" icon="o-magnifying-glass" kbd="Ctrl+K"
                class="hidden sm:flex lg:hidden xl:flex">{{ __('Search everything') }}</x-button>

            <x-separator variant="subtle" vertical class="hidden mx-2 my-2 sm:block lg:hidden xl:block" />

            <x-button variant="subtle" size="sm" icon="o-bell" tooltip="{{ __('Notification') }}" />
        </x-navbar>

        {{-- Auth --}}
        <x-dropdown position="bottom-end">
            <x-profile avatar="https://ui-avatars.com/api/?name=Jhon+Doe&color=27272a&background=00000000&format=svg" class="-mr-3" />

            <x-navmenu>
                <div class="px-2 py-1.5 max-w-48">
                    <x-heading class="truncate !mb-0">Jhon Doe</x-heading>
                    <x-subheading class="text-xs truncate">jhondoe@gmail.com</x-subheading>
                </div>
                <x-navmenu.separator />
                <x-navmenu.item icon="s-user-circle">{{ __('Account') }}</x-navmenu.item>
                <x-navmenu.item icon="s-arrow-right-start-on-rectangle">{{ __('Logout') }}</x-navmenu.item>
            </x-navmenu>
        </x-dropdown>

        {{-- Guest --}}
        {{-- <x-button wire:navigate href="/login" variant="outline" size="sm">{{ __('Login') }}</x-button> --}}
    </x-header>

    {{-- Desktop navigation --}}
    <x-sidebar sticky class="hidden border-r lg:flex bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-x-mark" class="lg:hidden" x-on:click="closeSidebar" />

        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-light.png') }}" name="{{ config('app.name') }}" class="flex dark:hidden px-2 !gap-2.5 rounded-lg" />
        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-dark.png') }}" name="{{ config('app.name') }}" class="hidden dark:flex px-2 !gap-2.5 rounded-lg" />

        <x-button variant="filled" size="sm" icon="o-magnifying-glass"
            class="hidden lg:flex !justify-start w-full !gap-3 !h-10 shrink-0 !rounded-lg">
            <div class="flex items-center justify-between w-full">
                <div>{{ __('Search') }}</div>
                <x-kbd>Ctrl + K</x-kbd>
            </div>
        </x-button>

        <x-navlist variant="outline">
            <x-navlist.item wire:navigate href="/" active icon="o-home">{{ __('Home') }}</x-navlist.item>
            <x-navlist.item icon="o-inbox" badge="10">{{ __('Inbox') }}</x-navlist.item>
            <x-navlist.item icon="o-document-text">{{ __('Documents') }}</x-navlist.item>
            <x-navlist.item icon="o-calendar">{{ __('Calendar') }}</x-navlist.item>
            <x-navlist.group expanded expandable heading="{{ __('Favorites') }}">
                <x-navlist.item>{{ __('Marketing site') }}</x-navlist.item>
                <x-navlist.item>{{ __('Android app') }}</x-navlist.item>
                <x-navlist.item>{{ __(' Brand guiddlines') }}</x-navlist.item>
            </x-navlist.group>
        </x-navlist>

        <x-spacer />

        <x-navlist>
            <x-theme-switcher variant="sidebar" />
            <x-navlist.item icon="o-bell">{{ __('Notification') }}</x-navlist.item>

            {{-- Guest --}}
            {{-- <x-navlist.item wire:navigate active href="/login" variant="outline" icon="l-log-in">{{ __('Login') }}</x-navlist.item> --}}
        </x-navlist>

        {{-- Auth --}}
        <x-dropdown position="top-start" class="w-full">
            <x-profile avatar="https://ui-avatars.com/api/?name=Jhon+Doe&color=27272a&background=00000000&format=svg"
                chevron="reverse" name="Jhon Doe" class="w-full" />

            <x-navmenu>
                <div class="px-2 py-1.5 max-w-48">
                    <x-heading class="truncate !mb-0">Jhon Doe</x-heading>
                    <x-subheading class="text-xs truncate">jhondoe@gmail.com</x-subheading>
                </div>
                <x-navmenu.separator />
                <x-navmenu.item icon="s-user-circle">{{ __('Account') }}</x-navmenu.item>
                <x-navmenu.item icon="s-arrow-right-start-on-rectangle">{{ __('Logout') }}</x-navmenu.item>
            </x-navmenu>
        </x-dropdown>
    </x-sidebar>

    {{-- Mobile navigation --}}
    <x-sidebar sticky transition x-cloak
        x-show="isSidebarOpen"
        x-trap.inert.noscroll="isSidebarOpen"
        x-on:resize.window="if (window.innerWidth >= 1024) isSidebarOpen = false"
        x-on:click.outside="closeSidebar"
        x-on:keydown.escape.stop="closeSidebar"
        class="border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-x-mark" class="lg:hidden" x-on:click="closeSidebar" />

        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-light.png') }}" name="{{ config('app.name') }}" class="flex dark:hidden px-2 !gap-2.5 rounded-lg" />
        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-dark.png') }}" name="{{ config('app.name') }}" class="hidden dark:flex px-2 !gap-2.5 rounded-lg" />

        <x-navlist variant="outline">
            <x-navlist.item wire:navigate href="/" active icon="o-home">{{ __('Home') }}</x-navlist.item>
            <x-navlist.item icon="o-inbox" badge="10">{{ __('Inbox') }}</x-navlist.item>
            <x-navlist.item icon="o-document-text">{{ __('Documents') }}</x-navlist.item>
            <x-navlist.item icon="o-calendar">{{ __('Calendar') }}</x-navlist.item>

            <x-navlist.group expanded expandable heading="{{ __('Favorites') }}">
                <x-navlist.item>{{ __('Marketing site') }}</x-navlist.item>
                <x-navlist.item>{{ __('Android app') }}</x-navlist.item>
                <x-navlist.item>{{ __(' Brand guiddlines') }}</x-navlist.item>
            </x-navlist.group>
        </x-navlist>

        <x-spacer />

        <x-navlist>
            <x-theme-switcher variant="sidebar"
                x-on:keydown.alt.l.window="lightMode()"
                x-on:keydown.alt.m.window="darkMode()"
                x-on:keydown.alt.p.window="systemMode()" />
        </x-navlist>
    </x-sidebar>

    {{-- Overlay sidebar open --}}
    <x-overlay x-show="isSidebarOpen" x-on:click="closeSidebar" class="lg:hidden" />

    {{-- Main --}}
    <x-main class="lg:pl-72">
        {{ $slot }}
    </x-main>
</x-page>
