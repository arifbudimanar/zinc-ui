<x-layout>
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    <x-slot:body>
        {{-- Desktop navigation --}}
        <x-sidebar sticky
            class="hidden border-r lg:flex bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">

            <x-button variant="subtle" icon="o-x-mark" class="lg:hidden" x-on:click="closeSidebar" />

            <x-brand class="px-2 !gap-2.5 rounded-lg" />

            @auth
                <x-button variant="filled" size="sm" icon="o-magnifying-glass"
                    class="hidden lg:flex !justify-start w-full !gap-3 !h-10 shrink-0 !rounded-lg">
                    <div class="flex items-center justify-between w-full">
                        <div>Search</div>
                        <x-kbd>Ctrl + K</x-kbd>
                    </div>
                </x-button>
            @endauth

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
                    <x-navlist.group heading="Favorites" expanded expandable>
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
            </x-navlist>

            <x-spacer />

            {{-- Bottom navlist --}}
            <x-navlist>
                <x-theme-switcher variant="sidebar" />

                @auth
                    <x-navlist.item icon="o-bell">Notification</x-navlist.item>
                @else
                    <x-navlist.item wire:navigate :active="true" :href="route('login')" variant="outline" icon="l-log-in">
                        Login
                    </x-navlist.item>
                @endauth
            </x-navlist>

            @auth
                <x-dropdown position="top-start" class="w-full">
                    <x-profile chevron="reverse" avatar="{{ Auth::user()->avatar_url }}" name="{{ Auth::user()->name }}"
                        class="w-full" />

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
            @endauth
        </x-sidebar>

        {{-- Mobile navigation --}}
        <x-sidebar sticky transition x-show="isSidebarOpen" x-trap.inert.noscroll="isSidebarOpen" x-cloak
            x-on:resize.window="if (window.innerWidth >= 1024) isSidebarOpen = false" x-on:click.outside="closeSidebar"
            x-on:keydown.escape="closeSidebar"
            class="border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">

            <x-button variant="subtle" icon="o-x-mark" class="lg:hidden" x-on:click="closeSidebar" />

            <x-brand class="px-2 !gap-2.5 rounded-lg" />

            <x-button variant="filled" size="sm" icon="o-magnifying-glass" kbd="Ctrl+K"
                class="hidden lg:flex !justify-start w-full !gap-3">
                Search
            </x-button>

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
                    <x-navlist.group heading="Favorites" expanded expandable>
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
            </x-navlist>

            <x-spacer />

            {{-- Bottom navlist --}}
            <x-navlist>
                <x-theme-switcher variant="sidebar" x-on:keydown.alt.l.window="lightMode()"
                    x-on:keydown.alt.m.window="darkMode()" x-on:keydown.alt.p.window="systemMode()" />
            </x-navlist>
        </x-sidebar>

        {{-- Header --}}
        <x-header sticky
            class="!block lg:pl-72 bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
            <x-navbar class="w-full !gap-0 lg:hidden">
                <x-button variant="subtle" icon="o-bars-2" x-on:click="openSidebar" class="-ml-3 lg:hidden" />

                <x-brand class="px-2 rounded-lg lg:-ml-2 lg:mr-4" />

                <x-spacer />

                @auth
                    <x-button variant="subtle" size="sm" icon="o-magnifying-glass" tooltip="Search"
                        class="mr-0.5 sm:hidden lg:flex xl:hidden" />

                    <x-button variant="filled" size="sm" icon="o-magnifying-glass" kbd="Ctrl+K"
                        class="hidden sm:flex lg:hidden xl:flex">
                        Search everything
                    </x-button>

                    <x-separator variant="subtle" vertical class="hidden mx-3 my-3 sm:block lg:hidden xl:block" />

                    <x-button variant="subtle" size="sm" icon="o-bell" tooltip="Notifications" class="mr-1" />

                    <x-dropdown position="bottom-end">
                        <x-profile avatar="{{ Auth::user()->avatar_url }}" class="-mr-3" />

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
            </x-navbar>

            <x-navbar scrollable class="no-scrollbar">
                <x-navbar.item :href="route('home')" wire:navigate :active="true">Dashboard</x-navbar.item>
                <x-navbar.item badge="32">Orders</x-navbar.item>
                <x-navbar.item>Catalog</x-navbar.item>
                <x-navbar.item>Configuration</x-navbar.item>
            </x-navbar>
        </x-header>

        <x-overlay x-show="isSidebarOpen" x-cloak x-on:click="closeSidebar" class="lg:hidden" />

        <x-main class="lg:pl-72">
            {{ $slot }}
        </x-main>
    </x-slot:body>
</x-layout>
