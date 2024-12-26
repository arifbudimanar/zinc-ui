<x-layout class="dark:!bg-zinc-900">
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    <x-slot:body>
        <x-header sticky class="!block bg-white border-b dark:bg-zinc-900 border-zinc-200 dark:border-white/10 !px-0">
            <x-container class="-my-1">
                <x-navbar>
                    <x-brand class="px-2 -ml-2 rounded-lg" />

                    <x-spacer />

                    <x-dropdown id="dropdown-menu" position="bottom-end" class="sm:hidden">
                        <x-button variant="subtle" icon="o-ellipsis-vertical" />
                        <x-menu>
                            <x-menu.item href="{{ route('docs.installation') }}" icon="o-book-open" wire:navigate>
                                Docs
                            </x-menu.item>
                            <x-menu.item icon="l-github">
                                Github
                            </x-menu.item>
                        </x-menu>
                    </x-dropdown>
                    <x-navbar class="hidden sm:flex">
                        <x-navbar.item href="{{ route('docs.installation') }}" icon="o-book-open" wire:navigate>
                            Docs
                        </x-navbar.item>
                        <x-navbar.item icon="l-github">
                            Github
                        </x-navbar.item>
                        <x-separator vertical class="mx-4 my-1" />
                    </x-navbar>
                    <x-theme-switcher variant="header" x-on:keydown.alt.l.window="lightMode()"
                        x-on:keydown.alt.m.window="darkMode()" x-on:keydown.alt.p.window="systemMode()" />
                    @auth
                        <x-navbar class="ml-1">
                            <x-dropdown position="bottom-end" class="-my-1">
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
                        </x-navbar>
                    @else
                        <x-navbar class="ml-2">
                            <x-button wire:navigate :href="route('login')" variant="outline" size="sm">
                                Login
                            </x-button>
                        </x-navbar>
                    @endauth
                </x-navbar>
            </x-container>

            <div class="mx-auto w-full [:where(&)]:max-w-7xl px-6 lg:px-8 flex items-center py-2 [:where(&)]:bg-white [:where(&)]:dark:bg-zinc-900 [:where(&)]:border-t [:where(&)]:border-zinc-200 dark:[:where(&)]:border-white/10 lg:hidden"
                data-container>
                <x-button variant="ghost" icon="o-bars-3" inset="left" x-on:click="openSidebar" />

                @isset($title)
                    <x-heading class="ml-2">
                        {{ $title }}
                    </x-heading>
                @endisset

                @isset($breadcrumbs)
                    {{ $breadcrumbs }}
                @endisset
            </div>
        </x-header>

        {{-- Mobile navigation --}}
        <x-sidebar sticky transition x-show="isSidebarOpen" x-trap.inert.noscroll="isSidebarOpen" x-cloak
            x-on:click.outside="closeSidebar" x-on:keydown.escape="closeSidebar"
            class="lg:hidden lg:mr-8 lg:w-44 max-lg:p-8 lg:pl-0 !gap-7 bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
            <x-button variant="subtle" icon="o-x-mark" x-on:click="closeSidebar" inset="left" />

            <x-sidebar.group heading="Guides">
                <x-sidebar.item href="{{ route('docs.installation', [], false) }}" wire:navigate>
                    Installation
                </x-sidebar.item>
                <x-sidebar.item href="/doc/principles">
                    Principles
                </x-sidebar.item>
                <x-sidebar.item href="/doc/patterns">
                    Patterns
                </x-sidebar.item>
                <x-sidebar.item href="/doc/customization">
                    Customization
                </x-sidebar.item>
                <x-sidebar.item href="/doc/help">
                    Help
                </x-sidebar.item>
            </x-sidebar.group>

            <x-sidebar.group heading="Layouts">
                <x-sidebar.item href="{{ route('layouts.header', [], false) }}" wire:navigate>
                    Header
                </x-sidebar.item>
                <x-sidebar.item href="{{ route('layouts.sidebar', [], false) }}" wire:navigate>
                    Sidebar
                </x-sidebar.item>
            </x-sidebar.group>

            <x-sidebar.group heading="Components">
                <x-sidebar.item href="/component/accordion">
                    Accordion
                </x-sidebar.item>
                <x-sidebar.item href="/component/autocomplete">
                    Autocomplete
                </x-sidebar.item>
                <x-sidebar.item href="/component/badge">
                    Badge
                </x-sidebar.item>
                <x-sidebar.item href="/component/button">
                    Button
                </x-sidebar.item>
                <x-sidebar.item href="/component/breadcrumbs">
                    Breadcrumbs
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Card
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Checkbox
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Command
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Context
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Dropdown
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Editor
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Field
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Heading
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Icon
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Input
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Modal
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Navbar
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Radio
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Select
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Separator
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Switch
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Table
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Tabs
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Textarea
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Toast
                </x-sidebar.item>
                <x-sidebar.item href="/component/card">
                    Tooltip
                </x-sidebar.item>
            </x-sidebar.group>
        </x-sidebar>

        <x-overlay x-show="isSidebarOpen" x-cloak x-on:click="closeSidebar" class="lg:hidden" />

        <x-container class="max-w-7xl">
            <div class="relative flex flex-row">
                {{-- Desktop navigation --}}
                <x-sidebar
                    class="hidden lg:flex fixed !h-[calc(100vh-4.75rem)] !min-h-[calc(100vh-4.75rem)] !max-h-[calc(100vh-4.75rem)] !w-44 !min-w-44 !max-w-44 pl-0 pr-3 py-11 gap-7 top-[4.75rem] border-t border-transparent">
                    <x-sidebar.group heading="Guides">
                        <x-sidebar.item href="{{ route('docs.installation', [], false) }}" wire:navigate>
                            Installation
                        </x-sidebar.item>
                        <x-sidebar.item href="/doc/principles">
                            Principles
                        </x-sidebar.item>
                        <x-sidebar.item href="/doc/patterns">
                            Patterns
                        </x-sidebar.item>
                        <x-sidebar.item href="/doc/customization">
                            Customization
                        </x-sidebar.item>
                        <x-sidebar.item href="/doc/help">
                            Help
                        </x-sidebar.item>
                    </x-sidebar.group>

                    <x-sidebar.group heading="Layouts">
                        <x-sidebar.item href="{{ route('layouts.header', [], false) }}" wire:navigate>
                            Header
                        </x-sidebar.item>
                        <x-sidebar.item href="{{ route('layouts.sidebar', [], false) }}" wire:navigate>
                            Sidebar
                        </x-sidebar.item>
                    </x-sidebar.group>

                    <x-sidebar.group heading="Components">
                        <x-sidebar.item href="/component/accordion">
                            Accordion
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/autocomplete">
                            Autocomplete
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/badge">
                            Badge
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/button">
                            Button
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/breadcrumbs">
                            Breadcrumbs
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Card
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Checkbox
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Command
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Context
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Dropdown
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Editor
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Field
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Heading
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Icon
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Input
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Modal
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Navbar
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Radio
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Select
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Separator
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Switch
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Table
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Tabs
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Textarea
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Toast
                        </x-sidebar.item>
                        <x-sidebar.item href="/component/card">
                            Tooltip
                        </x-sidebar.item>
                    </x-sidebar.group>
                </x-sidebar>

                <x-main class="!px-0 lg:!pl-52 lg:py-12">
                    {{ $slot }}
                </x-main>

                <x-sidebar
                    class="![grid-area:aside] sticky
                    top-[8.3rem] !h-[calc(100vh-8.3rem)] !min-h-[calc(100vh-8.3rem)] !max-h-[calc(100vh-8.3rem)]
                    lg:top-[4.75rem] lg:!h-[calc(100vh-4.75rem)] lg:!min-h-[calc(100vh-4.75rem)] lg:!max-h-[calc(100vh-4.75rem)] !w-44 !min-w-44 !max-w-44 hidden md:flex lg:!pr-0 md:py-8 lg:py-12 md:pl-6 lg:pl-8">
                    <div class="space-y-2 text-base text-zinc-500 dark:text-zinc-400">
                        <div class="font-medium">
                            On this page
                        </div>
                        <div>
                            <x-sidebar.item href="/doc">
                                Introduction
                            </x-sidebar.item>
                            <x-sidebar.item href="#variant">
                                Variant
                            </x-sidebar.item>
                            <x-sidebar.item href="#sizes">
                                Sizes
                            </x-sidebar.item>
                        </div>
                    </div>
                </x-sidebar>
            </div>
        </x-container>
        {{-- <x-container class="[grid-area:footer] lg:pl-60 md:pr-[12.5rem] lg:pr-[13rem]">
            <x-separator variant="subtle" />
            <div class="flex flex-col items-center gap-2 py-8 sm:flex-row sm:justify-between">
                <x-subheading>
                    Copyright © {{ now()->year }} {{ config('app.name') }}
                </x-subheading>
                <x-subheading>
                    Built with by
                    <x-link href="https://github.com/arifbudimanar" target="_blank">
                        Arif Budiman Arrosyid
                    </x-link>
                </x-subheading>
            </div>
        </x-container> --}}
    </x-slot:body>
</x-layout>
