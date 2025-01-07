<x-page class="dark:!bg-zinc-900">
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    <x-header sticky class="!block bg-white border-b dark:bg-zinc-900 border-zinc-200 dark:border-white/10 !px-0">
        <x-container>
            <x-navbar class="min-h-[4.5rem] w-full relative">
                <div class="flex items-center">
                    <x-brand class="px-2 -ml-2 rounded-lg" />
                    <x-badge color="orange">Alpha</x-badge>
                </div>

                <x-spacer />

                <x-dropdown id="dropdown-menu" position="bottom-end" class="mr-2 sm:hidden">
                    <x-button variant="subtle" icon="o-ellipsis-vertical" />
                    <x-menu>
                        <x-menu.item href="/docs" icon="o-book-open" wire:navigate>
                            {{ __('Docs') }}
                        </x-menu.item>
                        <x-menu.item href="https://github.com/arifbudimanar/zinc-ui" icon="l-github" target="_blank">
                            {{ __('Github') }}
                        </x-menu.item>
                    </x-menu>
                </x-dropdown>

                <x-navbar.item href="/docs" icon="o-book-open" wire:navigate class="hidden sm:flex">
                    {{ __('Docs') }}
                </x-navbar.item>
                <x-navbar.item href="https://github.com/arifbudimanar/zinc-ui" icon="l-github" target="_blank"
                    class="hidden sm:flex">
                    {{ __('Github') }}
                </x-navbar.item>
                <x-separator vertical class="hidden mx-4 my-3 sm:flex" />

                <x-theme-switcher variant="header" x-on:keydown.alt.l.window="lightMode()"
                    x-on:keydown.alt.m.window="darkMode()" x-on:keydown.alt.p.window="systemMode()" />

                @auth
                    <x-dropdown position="bottom-end" class="ml-1 -my-1">
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
                                <x-menu.item wire:navigate href="/logout"
                                    icon="l-log-out">{{ __('Logout') }}</x-menu.item>
                            </x-menu.group>
                        </x-menu>
                    </x-dropdown>
                @else
                    <x-button wire:navigate :href="route('login')" variant="outline" size="sm" class="ml-2">
                        {{ __('Login') }}
                    </x-button>
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
        class="lg:hidden lg:mr-8 p-8 !gap-7 bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <x-button variant="subtle" icon="o-x-mark" x-on:click="closeSidebar" inset="left top bottom" />

        <x-sidebar.group heading="Guides">
            <x-sidebar.item href="/docs/installation" wire:navigate>
                {{ __('Installation') }}</x-sidebar.item>
            <x-sidebar.item href="/docs/dark-mode" wire:navigate>
                {{ __('Dark mode') }}
            </x-sidebar.item>
            {{-- <x-sidebar.item href="/docs/principles" wire:navigate>
                    {{ __('Principles') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/docs/patterns" wire:navigate>
                    {{ __('Patterns') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/docs/customization" wire:navigate>
                    {{ __('Customization') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/docs/help" wire:navigate>
                    {{ __('Help') }}
                </x-sidebar.item> --}}
        </x-sidebar.group>

        <x-sidebar.group heading="Layouts">
            <x-sidebar.item href="/layouts/header" wire:navigate>
                {{ __('Header') }}
            </x-sidebar.item>
            <x-sidebar.item href="/layouts/sidebar" wire:navigate>
                {{ __('Sidebar') }}
            </x-sidebar.item>
        </x-sidebar.group>

        <x-sidebar.group heading="Components">
            {{-- <x-sidebar.item href="/components/accordion" wire:navigate>
                    {{ __('Accordion') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/autocomplete" wire:navigate>
                    {{ __('Autocomplete') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/badge" wire:navigate>
                    {{ __('Badge') }}
                </x-sidebar.item> --}}
            <x-sidebar.item href="/components/button" wire:navigate>
                {{ __('Button') }}
            </x-sidebar.item>
            {{-- <x-sidebar.item href="/components/breadcrumbs" wire:navigate>
                    {{ __('Breadcrumbs') }}
                </x-sidebar.item> --}}
            <x-sidebar.item href="/components/card" wire:navigate>
                {{ __('Card') }}
            </x-sidebar.item>
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Checkbox') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Command') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Context') }}
                </x-sidebar.item> --}}
            <x-sidebar.item href="/components/dropdown" wire:navigate>
                {{ __('Dropdown') }}
            </x-sidebar.item>
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Editor') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Field') }}
                </x-sidebar.item> --}}
            <x-sidebar.item href="/components/heading" wire:navigate>
                {{ __('Heading') }}
            </x-sidebar.item>
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Icon') }}
                </x-sidebar.item> --}}
            <x-sidebar.item href="/components/input" wire:navigate>
                {{ __('Input') }}
            </x-sidebar.item>
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Modal') }}
                </x-sidebar.item> --}}
            <x-sidebar.item href="/components/navbar" wire:navigate>
                {{ __('Navbar') }}
            </x-sidebar.item>
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Radio') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Select') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Separator') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Switch') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Table') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Tabs') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Textarea') }}
                </x-sidebar.item> --}}
            {{-- <x-sidebar.item href="/components/card" wire:navigate>
                    {{ __('Toast') }}
                </x-sidebar.item> --}}
            <x-sidebar.item href="/components/tooltip" wire:navigate>
                {{ __('Tooltip') }}
            </x-sidebar.item>
        </x-sidebar.group>
    </x-sidebar>

    <x-overlay x-show="isSidebarOpen" x-cloak x-on:click="closeSidebar" class="lg:hidden" />

    <x-container class="max-w-7xl">
        <div class="relative flex flex-row">
            {{-- Desktop navigation --}}
            <x-sidebar
                class="hidden lg:flex fixed !h-[calc(100vh-4.5rem)] !min-h-[calc(100vh-4.5rem)] !max-h-[calc(100vh-4.5rem)] !w-44 !min-w-44 !max-w-44 pl-0 pr-3 py-12 gap-7 top-[4.5rem] border-t border-transparent">
                <x-sidebar.group heading="Guides">
                    <x-sidebar.item href="/docs/installation" wire:navigate>
                        {{ __('Installation') }}
                    </x-sidebar.item>
                    <x-sidebar.item href="/docs/dark-mode" wire:navigate>
                        {{ __('Dark mode') }}
                    </x-sidebar.item>
                    {{-- <x-sidebar.item href="/docs/principles" wire:navigate>
                            {{ __('Principles') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/docs/patterns" wire:navigate>
                            {{ __('Patterns') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/docs/customization" wire:navigate>
                            {{ __('Customization') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/docs/help" wire:navigate>
                            {{ __('Help') }}
                        </x-sidebar.item> --}}
                </x-sidebar.group>

                <x-sidebar.group heading="Layouts">
                    <x-sidebar.item href="/layouts/header" wire:navigate>
                        {{ __('Header') }}</x-sidebar.item>
                    <x-sidebar.item href="/layouts/sidebar" wire:navigate>
                        {{ __('Sidebar') }}</x-sidebar.item>
                </x-sidebar.group>

                <x-sidebar.group heading="Components">
                    {{-- <x-sidebar.item href="/components/accordion" wire:navigate>
                            {{ __('Accordion') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/autocomplete" wire:navigate>
                            {{ __('Autocomplete') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/badge" wire:navigate>
                            {{ __('Badge') }}
                        </x-sidebar.item> --}}
                    <x-sidebar.item href="/components/button" wire:navigate>
                        {{ __('Button') }}
                    </x-sidebar.item>
                    {{-- <x-sidebar.item href="/components/breadcrumbs" wire:navigate>
                            {{ __('Breadcrumbs') }}
                        </x-sidebar.item> --}}
                    <x-sidebar.item href="/components/card" wire:navigate>
                        {{ __('Card') }}
                    </x-sidebar.item>
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Checkbox') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Command') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Context') }}
                        </x-sidebar.item> --}}
                    <x-sidebar.item href="/components/dropdown" wire:navigate>
                        {{ __('Dropdown') }}
                    </x-sidebar.item>
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Editor') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Field') }}
                        </x-sidebar.item> --}}
                    <x-sidebar.item href="/components/heading" wire:navigate>
                        {{ __('Heading') }}
                    </x-sidebar.item>
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Icon') }}
                        </x-sidebar.item> --}}
                    <x-sidebar.item href="/components/input" wire:navigate>
                        {{ __('Input') }}
                    </x-sidebar.item>
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Modal') }}
                        </x-sidebar.item> --}}
                    <x-sidebar.item href="/components/navbar" wire:navigate>
                        {{ __('Navbar') }}
                    </x-sidebar.item>
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Radio') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Select') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Separator') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Switch') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Table') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Tabs') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Textarea') }}
                        </x-sidebar.item> --}}
                    {{-- <x-sidebar.item href="/components/card" wire:navigate>
                            {{ __('Toast') }}
                        </x-sidebar.item> --}}
                    <x-sidebar.item href="/components/tooltip" wire:navigate>
                        {{ __('Tooltip') }}
                    </x-sidebar.item>
                </x-sidebar.group>
            </x-sidebar>

            <x-main class="!px-0 lg:!pl-52 lg:py-12">
                {{ $slot }}
            </x-main>

            <x-sidebar
                class="![grid-area:aside] sticky hidden md:flex !w-44 !min-w-44 !max-w-44 lg:!pr-0 md:py-8 lg:py-14 md:pl-6 lg:pl-8
                    top-[calc(4.5rem+3.5rem+2px)] !h-[calc(100vh-(4.5rem+3.5rem+2px))] !min-h-[calc(100vh-(4.5rem+3.5rem+2px))] !max-h-[calc(100vh-(4.5rem+3.5rem+2px))]
                    lg:top-[calc(4.5rem+1px)] lg:!h-[calc(100vh-(4.5rem+1px))] lg:!min-h-[calc(100vh-(4.5rem+1px))] lg:!max-h-[calc(100vh-(4.5rem+1px))]">
                <div class="space-y-2 text-base text-zinc-500 dark:text-zinc-400">
                    <div class="font-medium">{{ __('On this page') }}</div>
                    <div x-data="{ scrollOffset: window.innerWidth >= 1024 ? '7.6rem' : '9.6rem' }" x-init="window.addEventListener('resize', () => scrollOffset = window.innerWidth >= 1024 ? '7.6rem' : '9.6rem')">
                        <template x-for="el in document.querySelectorAll('[data-aside-title]')" :key="el">
                            <a x-init="el.id = el.textContent.trim().replace(/\s+/g, '-').toLowerCase();
                            $el.setAttribute('href', '#' + el.id);" x-on:click="el.style.scrollMarginTop = scrollOffset"
                                x-bind:data-level="el.getAttribute('data-aside-title')"
                                class="group block first-of-type:pt-0 last-of-type:pb-0 hover:text-zinc-800 dark:hover:text-white
                                           data-[level=3]:text-sm data-[level=3]:font-normal
                                           [&[data-level='3']+[data-level='2']]:pt-3 border-l-2 border-zinc-100 dark:border-zinc-700">
                                <p x-text="el.hasAttribute('data-aside-label') ? el.getAttribute('data-aside-label') : el.textContent"
                                    class="border-l-2 border-transparent pl-4 group-data-[level=3]:pl-8 py-1 -ml-0.5"
                                    :class="{
                                        'font-medium text-zinc-800 dark:text-white border-zinc-800 dark:border-white': $store
                                            .tocNavHighlighter.visibleHeadingId === el.id,
                                        'border-transparent': $store.tocNavHighlighter.visibleHeadingId !== el.id
                                    }">
                                </p>
                            </a>
                        </template>
                    </div>
                </div>
            </x-sidebar>

            <x-container class="[grid-area:footer] !px-0 lg:!pl-52">
                <x-separator variant="subtle" />
                <div class="flex flex-col items-center gap-2 py-8 sm:flex-row sm:justify-between">
                    <x-subheading>
                        Copyright © {{ now()->year }} {{ config('app.name') }}
                    </x-subheading>
                    <x-subheading>
                        {{ __('Built by') }}
                        <x-link variant="subtle" href="https://github.com/arifbudimanar" target="_blank">
                            Arif Budiman Arrosyid
                        </x-link>
                    </x-subheading>
                </div>
            </x-container>
        </div>
    </x-container>
</x-page>
