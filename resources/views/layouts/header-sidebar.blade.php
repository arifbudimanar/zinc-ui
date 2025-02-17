<x-page>
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    {{-- Desktop navigation --}}
    <x-header container sticky class="border-b bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-bars-2" x-on:click="openSidebar" class="-ml-3 md:ml-0 lg:hidden" />

        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-light.png') }}" name="{{ config('app.name') }}" class="flex px-2 rounded-lg dark:hidden lg:-ml-2 lg:mr-4" />
        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-dark.png') }}" name="{{ config('app.name') }}" class="hidden px-2 rounded-lg dark:flex lg:-ml-2 lg:mr-4" />

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
        {{-- <x-button variant="outline" size="sm">{{ __('Login') }}</x-button> --}}
    </x-header>

    {{-- Mobile navigation --}}
    <x-sidebar sticky transition
        x-show="isSidebarOpen" x-cloak
        x-trap.inert.noscroll="isSidebarOpen"
        x-on:click.outside="closeSidebar"
        x-on:keydown.escape="closeSidebar"
        class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-x-mark" x-on:click="closeSidebar" />

        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-light.png') }}" name="{{ config('app.name') }}" class="flex dark:hidden px-2 !gap-2.5 rounded-lg" />
        <x-brand wire:navigate href="/" logo="{{ asset('logos/brand-dark.png') }}" name="{{ config('app.name') }}" class="hidden dark:flex px-2 !gap-2.5 rounded-lg" />

        <x-navlist variant="outline">
            <x-navlist.item wire:navigate href="/" active icon="o-home">{{ __('Home') }}</x-navlist.item>
            <x-navlist.item icon="o-inbox" badge="10">{{ __('Inbox') }}</x-navlist.item>
            <x-navlist.item icon="o-document-text">{{ __('Documents') }}</x-navlist.item>
            <x-navlist.item icon="o-calendar">{{ __('Calendar') }}</x-navlist.item>

            <x-navlist.group heading="{{ __('Favorites') }}">
                <x-navlist.item>{{ __('Marketing site') }}</x-navlist.item>
                <x-navlist.item>{{ __('Android app') }}</x-navlist.item>
                <x-navlist.item>{{ __('Brand guiddlines') }}</x-navlist.item>
            </x-navlist.group>

            <x-navlist.group heading="{{ __('Other Menu') }}" class="md:hidden">
                <x-navlist.item>{{ __('Dashboard') }}</x-navlist.item>
                <x-navlist.item badge="32">{{ __('Orders') }}</x-navlist.item>
                <x-navlist.item>{{ __('Catalog') }}</x-navlist.item>
                <x-navlist.item>{{ __('Payments') }}</x-navlist.item>
                <x-navlist.item>{{ __('Customers') }}</x-navlist.item>
                <x-navlist.item>{{ __('Billing') }}</x-navlist.item>
                <x-navlist.item>{{ __('Quotes') }}</x-navlist.item>
                <x-navlist.item>{{ __('Configuration') }}</x-navlist.item>
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
    <x-main container>
        <x-aside>
            <x-aside.navigation class="hidden w-full max-w-56 md:flex">
                <x-navlist variant="filled">
                    <x-navlist.item active>{{ __('Dashboard') }}</x-navlist.item>
                    <x-navlist.item badge="32">{{ __('Orders') }}</x-navlist.item>
                    <x-navlist.item>{{ __('Catalog') }}</x-navlist.item>
                    <x-navlist.item>{{ __('Payments') }}</x-navlist.item>
                    <x-navlist.item>{{ __('Customers') }}</x-navlist.item>
                    <x-navlist.item>{{ __('Billing') }}</x-navlist.item>
                    <x-navlist.item>{{ __('Quotes') }}</x-navlist.item>
                    <x-navlist.item>{{ __('Configuration') }}</x-navlist.item>
                </x-navlist>
            </x-aside.navigation>

            <x-aside.panel class="max-w-full w-[calc(100%-(14rem+2.25rem))]">
                {{ $slot }}
            </x-aside.panel>
        </x-aside>
    </x-main>
</x-page>
