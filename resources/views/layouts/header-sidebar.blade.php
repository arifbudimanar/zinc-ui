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

            {{-- Left navbar --}}
            <x-navbar class="-mb-px max-lg:hidden">
                <x-navbar.item :href="route('home')" wire:navigate :active="true" icon="o-home">Home</x-navbar.item>

                <x-navbar.item icon="o-inbox" badge="10">Inbox</x-navbar.item>

                <x-navbar.item icon="o-document-text">Documents</x-navbar.item>

                <x-navbar.item icon="o-calendar">Calendar</x-navbar.item>

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
                            <x-navmenu.item>Marketing site</x-navmenu.item>

                            <x-navmenu.item>Android app</x-navmenu.item>

                            <x-navmenu.item>Brand guidlines</x-navmenu.item>
                        </x-navmenu>
                    </x-dropdown>
                @endauth
            </x-navbar>

            <x-spacer />

            {{-- Right navbar --}}
            <x-navbar class="mr-2">
                @auth
                    <x-button variant="subtle" size="sm" icon="o-magnifying-glass" tooltip="Search"
                        class="sm:hidden lg:flex xl:hidden" />

                    <x-button variant="filled" size="sm" icon="o-magnifying-glass" kbd="Ctrl+K"
                        class="hidden sm:flex lg:hidden xl:flex">
                        Search everything
                    </x-button>

                    <x-separator variant="subtle" vertical class="hidden mx-2 my-2 sm:block lg:hidden xl:block" />
                @endauth

                <x-theme-switcher variant="header" class="hidden lg:block" />

                @auth
                    <x-button variant="subtle" size="sm" icon="o-bell" tooltip="Notifications" />
                @endauth
            </x-navbar>

            @auth
                <x-dropdown position="bottom-end">
                    <x-profile avatar="{{ Auth::user()->avatar_url }}" class="-mr-3 md:mr-0 lg:-mr-3" />

                    <x-menu>
                        <div class="px-2 py-1.5 max-w-48">
                            <x-heading class="truncate !mb-0">
                                {{ Auth::user()->name }}
                            </x-heading>

                            <x-subheading class="text-xs truncate">
                                {{ Auth::user()->email }}
                            </x-subheading>
                        </div>

                        <x-menu.group>
                            <x-menu.item :href="route('home')" wire:navigate icon="o-home">
                                Home
                            </x-menu.item>

                            <x-menu.item icon="o-rectangle-stack">
                                Dashboard
                            </x-menu.item>
                        </x-menu.group>

                        <x-menu.group>
                            <x-menu.item :href="route('user.account')" wire:navigate icon="o-user-circle">
                                Account
                            </x-menu.item>

                            <x-menu.item icon="o-cog-8-tooth">
                                Settings
                            </x-menu.item>
                        </x-menu.group>


                        <x-menu.group>
                            @if (session()->has('auth.password_confirmed_at'))
                                <x-menu.item variant="danger" icon="o-x-circle">
                                    Disable Admin Mode
                                </x-menu.item>
                            @endif

                            <x-menu.item :href="route('logout')" wire:navigate icon="l-log-out">
                                Logout
                            </x-menu.item>
                        </x-menu.group>
                    </x-menu>
                </x-dropdown>
            @else
                <x-button wire:navigate :href="route('login')" variant="outline" size="sm">
                    Login
                </x-button>
            @endauth
        </x-header>

        {{-- Mobile navigation --}}
        <x-sidebar sticky transition x-show="isSidebarOpen" x-trap.inert.noscroll="isSidebarOpen" x-cloak
            x-on:click.outside="closeSidebar" x-on:keydown.escape="closeSidebar"
            class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
            <x-button variant="subtle" icon="o-x-mark" x-on:click="closeSidebar" />

            <x-brand class="px-2 !gap-2.5 rounded-lg" />

            {{-- Top navlist --}}
            <x-navlist variant="outline">
                <x-navlist.item :href="route('home')" wire:navigate :active="true" icon="o-home">
                    Home
                </x-navlist.item>

                <x-navlist.item icon="o-inbox" badge="10">
                    Inbox
                </x-navlist.item>

                <x-navlist.item icon="o-document-text">
                    Documents
                </x-navlist.item>

                <x-navlist.item icon="o-calendar">
                    Calendar
                </x-navlist.item>

                @auth
                    <x-navlist.group heading="Favorites" class="mt-4">
                        <x-navlist.item>
                            Marketing site
                        </x-navlist.item>

                        <x-navlist.item>
                            Android app
                        </x-navlist.item>

                        <x-navlist.item>
                            Brand guiddlines
                        </x-navlist.item>
                    </x-navlist.group>
                @endauth

                <x-navlist.group heading="Other Menu" class="mt-4 md:hidden">
                    <x-navlist.item :active="true">Dashboard</x-navlist.item>
                    <x-navlist.item badge="32">Orders</x-navlist.item>
                    <x-navlist.item>Catalog</x-navlist.item>
                    <x-navlist.item>Payments</x-navlist.item>
                    <x-navlist.item>Customers</x-navlist.item>
                    <x-navlist.item>Billing</x-navlist.item>
                    <x-navlist.item>Quotes</x-navlist.item>
                    <x-navlist.item>Configuration</x-navlist.item>
                </x-navlist.group>
            </x-navlist>

            <x-spacer />

            {{-- Bottom navlist --}}
            <x-navlist>
                <x-theme-switcher variant="sidebar" x-on:keydown.alt.l.window="lightMode()"
                    x-on:keydown.alt.m.window="darkMode()" x-on:keydown.alt.p.window="systemMode()" />
            </x-navlist>
        </x-sidebar>

        <x-overlay x-show="isSidebarOpen" x-cloak x-on:click="closeSidebar" class="lg:hidden" />

        <x-main container class="max-w-7xl">
            <x-aside>
                <x-aside.navigation class="hidden md:flex">
                    <x-navlist variant="filled">
                        <x-navlist.item :active="true">Dashboard</x-navlist.item>
                        <x-navlist.item badge="32">Orders</x-navlist.item>
                        <x-navlist.item>Catalog</x-navlist.item>
                        <x-navlist.item>Payments</x-navlist.item>
                        <x-navlist.item>Customers</x-navlist.item>
                        <x-navlist.item>Billing</x-navlist.item>
                        <x-navlist.item>Quotes</x-navlist.item>
                        <x-navlist.item>Configuration</x-navlist.item>
                    </x-navlist>
                </x-aside.navigation>

                <x-aside.panel>
                    {{ $slot }}
                </x-aside.panel>
            </x-aside>
        </x-main>
    </x-slot:body>
</x-layout>
