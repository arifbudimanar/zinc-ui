<x-layout>
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    <x-slot:body>
        {{-- Desktop navigation --}}
        <x-header container sticky class="border-b bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
            <x-button variant="subtle" icon="o-bars-2" x-on:click="openSidebar" class="-ml-3 md:ml-0 lg:hidden" />
            <x-brand class="px-2 rounded-lg lg:-ml-2 lg:mr-4" />
            <x-navbar class="-mb-px max-lg:hidden">
                <x-navbar.item wire:navigate href="/" active icon="o-home">{{ __('Home') }}</x-navbar.item>
                <x-navbar.item icon="o-inbox" badge="10">{{ __('Inbox') }}</x-navbar.item>
                <x-navbar.item icon="o-document-text">{{ __('Documents') }}</x-navbar.item>
                <x-navbar.item icon="o-calendar">{{ __('Calendar') }}</x-navbar.item>
                @auth
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
                @endauth
            </x-navbar>
            <x-spacer />
            <x-navbar class="mr-2">
                @auth
                    <x-button variant="subtle" size="sm" icon="o-magnifying-glass" tooltip="{{ __('Search') }}"
                        class="sm:hidden lg:flex xl:hidden" />
                    <x-button variant="filled" size="sm" icon="o-magnifying-glass" kbd="Ctrl+K"
                        class="hidden sm:flex lg:hidden xl:flex">{{ __('Search everything') }}</x-button>
                    <x-separator variant="subtle" vertical class="hidden mx-2 my-2 sm:block lg:hidden xl:block" />
                @endauth
                <x-theme-switcher variant="header" class="hidden lg:block" />
                @auth
                    <x-button variant="subtle" size="sm" icon="o-bell" tooltip="{{ __('Notifications') }}" />
                @endauth
            </x-navbar>
            @auth
                <x-dropdown position="bottom-end">
                    <x-profile avatar="{{ Auth::user()->avatar_url }}" class="-mr-3" />
                    <x-menu>
                        <div class="px-2 py-1.5 max-w-48">
                            <x-heading class="truncate !mb-0">{{ Auth::user()->name }}</x-heading>
                            <x-subheading class="text-xs truncate">{{ Auth::user()->email }}</x-subheading>
                        </div>
                        <x-menu.group>
                            <x-menu.item wire:navigate href="/" icon="o-home">{{ __('Home') }}</x-menu.item>
                            <x-menu.item wire:navigate href="/user/dashboard"
                                icon="o-rectangle-stack">{{ __('Dashboard') }}</x-menu.item>
                        </x-menu.group>
                        <x-menu.group>
                            <x-menu.item wire:navigate href="/user/account"
                                icon="o-user-circle">{{ __('Account') }}</x-menu.item>
                            <x-menu.item wire:navigate href="/user/settings"
                                icon="o-cog-8-tooth">{{ __('Settings') }}</x-menu.item>
                        </x-menu.group>
                        <x-menu.group>
                            @if (session()->has('auth.password_confirmed_at'))
                                <x-menu.item variant="danger"
                                    icon="o-x-circle">{{ __('Disable Admin Mode') }}</x-menu.item>
                            @endif
                            <x-menu.item wire:navigate href="/logout" icon="l-log-out">{{ __('Logout') }}</x-menu.item>
                        </x-menu.group>
                    </x-menu>
                </x-dropdown>
            @else
                <x-button wire:navigate href="/login" variant="outline" size="sm">{{ __('Login') }}</x-button>
            @endauth
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
                @auth
                    <x-navlist.group heading="{{ __('Favorites') }}" class="mt-4">
                        <x-navlist.item>{{ __('Marketing site') }}</x-navlist.item>
                        <x-navlist.item>{{ __('Android app') }}</x-navlist.item>
                        <x-navlist.item>{{ __('Brand guiddlines') }}</x-navlist.item>
                    </x-navlist.group>
                @endauth
                <x-navlist.group heading="{{ __('Other Menu') }}" class="mt-4 md:hidden">
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
                <x-theme-switcher variant="sidebar" x-on:keydown.alt.l.window="lightMode()"
                    x-on:keydown.alt.m.window="darkMode()" x-on:keydown.alt.p.window="systemMode()" />
            </x-navlist>
        </x-sidebar>

        {{-- Overlay sidebar open --}}
        <x-overlay x-show="isSidebarOpen" x-cloak x-on:click="closeSidebar" class="lg:hidden" />

        {{-- Main --}}
        <x-main container class="max-w-7xl">
            <x-aside>
                <x-aside.navigation class="hidden md:flex">
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
                <x-aside.panel>
                    {{ $slot }}
                </x-aside.panel>
            </x-aside>
        </x-main>
    </x-slot:body>
</x-layout>
