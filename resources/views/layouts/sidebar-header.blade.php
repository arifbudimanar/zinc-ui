<x-page>
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    {{-- Header --}}
    <x-header sticky class="!block lg:pl-72 bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <x-navbar class="w-full !gap-0 lg:hidden">
            <x-button variant="subtle" icon="o-bars-2" x-on:click="openSidebar" class="-ml-3 lg:hidden" />
            <x-brand class="px-2 rounded-lg lg:-ml-2 lg:mr-4" />
            <x-spacer />
            @auth
                <x-button variant="subtle" size="sm" icon="o-magnifying-glass" tooltip="{{ __('Search') }}"
                    class="mr-0.5 sm:hidden lg:flex xl:hidden" />
                <x-button variant="filled" size="sm" icon="o-magnifying-glass" kbd="Ctrl+K"
                    class="hidden sm:flex lg:hidden xl:flex">{{ __('Search everything') }}</x-button>
                <x-separator variant="subtle" vertical class="hidden mx-3 my-3 sm:block lg:hidden xl:block" />
                <x-button variant="subtle" size="sm" icon="o-bell" tooltip="{{ __('Notifications') }}"
                    class="mr-1" />
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
        </x-navbar>
        <x-navbar scrollable class="no-scrollbar">
            <x-navbar.item active>{{ __('Dashboard') }}</x-navbar.item>
            <x-navbar.item badge="32">{{ __('Orders') }}</x-navbar.item>
            <x-navbar.item>{{ __('Catalog') }}</x-navbar.item>
            <x-navbar.item>{{ __('Payments') }}</x-navbar.item>
            <x-navbar.item>{{ __('Customers') }}</x-navbar.item>
            <x-navbar.item>{{ __('Billing') }}</x-navbar.item>
            <x-navbar.item>{{ __('Quotes') }}</x-navbar.item>
            <x-navbar.item>{{ __('Configuration') }}</x-navbar.item>
        </x-navbar>
    </x-header>

    {{-- Desktop navigation --}}
    <x-sidebar sticky class="hidden border-r lg:flex bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-x-mark" class="lg:hidden" x-on:click="closeSidebar" />
        <x-brand class="px-2 !gap-2.5 rounded-lg" />
        @auth
            <x-button variant="filled" size="sm" icon="o-magnifying-glass"
                class="hidden lg:flex !justify-start w-full !gap-3 !h-10 shrink-0 !rounded-lg">
                <div class="flex items-center justify-between w-full">
                    <div>{{ __('Search') }}</div>
                    <x-kbd>Ctrl + K</x-kbd>
                </div>
            </x-button>
        @endauth
        <x-navlist variant="outline">
            <x-navlist.item wire:navigate href="/" active icon="o-home">{{ __('Home') }}</x-navlist.item>
            <x-navlist.item icon="o-inbox" badge="10">{{ __('Inbox') }}</x-navlist.item>
            <x-navlist.item icon="o-document-text">{{ __('Documents') }}</x-navlist.item>
            <x-navlist.item icon="o-calendar">{{ __('Calendar') }}</x-navlist.item>
            @auth
                <x-navlist.group expanded expandable heading="{{ __('Favorites') }}">
                    <x-navlist.item>{{ __('Marketing site') }}</x-navlist.item>
                    <x-navlist.item>{{ __('Android app') }}</x-navlist.item>
                    <x-navlist.item>{{ __(' Brand guiddlines') }}</x-navlist.item>
                </x-navlist.group>
            @endauth
        </x-navlist>
        <x-spacer />
        <x-navlist>
            <x-theme-switcher variant="sidebar" />
            @auth
                <x-navlist.item icon="o-bell">{{ __('Notification') }}</x-navlist.item>
            @else
                <x-navlist.item wire:navigate active href="/login" variant="outline"
                    icon="l-log-in">{{ __('Login') }}</x-navlist.item>
            @endauth
        </x-navlist>
        @auth
            <x-dropdown position="top-start" class="w-full">
                <x-profile chevron="reverse" avatar="{{ Auth::user()->avatar_url }}" name="{{ Auth::user()->name }}"
                    class="w-full" />
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
                            <x-menu.item variant="danger" icon="o-x-circle">{{ __('Disable Admin Mode') }}</x-menu.item>
                        @endif
                        <x-menu.item wire:navigate href="/logout" icon="l-log-out">{{ __('Logout') }}</x-menu.item>
                    </x-menu.group>
                </x-menu>
            </x-dropdown>
        @endauth
    </x-sidebar>

    {{-- Mobile navigation --}}
    <x-sidebar sticky transition x-show="isSidebarOpen" x-trap.inert.noscroll="isSidebarOpen" x-cloak
        x-on:resize.window="if (window.innerWidth >= 1024) isSidebarOpen = false" x-on:click.outside="closeSidebar"
        x-on:keydown.escape="closeSidebar"
        class="border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-x-mark" class="lg:hidden" x-on:click="closeSidebar" />
        <x-brand class="px-2 !gap-2.5 rounded-lg" />
        <x-navlist variant="outline">
            <x-navlist.item wire:navigate href="/" active icon="o-home">{{ __('Home') }}</x-navlist.item>
            <x-navlist.item icon="o-inbox" badge="10">{{ __('Inbox') }}</x-navlist.item>
            <x-navlist.item icon="o-document-text">{{ __('Documents') }}</x-navlist.item>
            <x-navlist.item icon="o-calendar">{{ __('Calendar') }}</x-navlist.item>
            @auth
                <x-navlist.group expanded expandable heading="{{ __('Favorites') }}">
                    <x-navlist.item>{{ __('Marketing site') }}</x-navlist.item>
                    <x-navlist.item>{{ __('Android app') }}</x-navlist.item>
                    <x-navlist.item>{{ __(' Brand guiddlines') }}</x-navlist.item>
                </x-navlist.group>
            @endauth
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
    <x-main class="lg:pl-72">
        {{ $slot }}
    </x-main>
</x-page>
