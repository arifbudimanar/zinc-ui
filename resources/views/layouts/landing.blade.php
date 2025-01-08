<x-page class="dark:!bg-zinc-900">
    <x-slot:head>
        <title>
            {{ config('app.name') ?? __('Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}
        </title>
    </x-slot:head>

    <x-header container sticky
        class="!block bg-white border-b dark:bg-zinc-900 border-zinc-200 dark:border-white/10 !px-0">
        <x-navbar class="min-h-[4.5rem] w-full relative">
            <div class="flex items-center">
                <x-brand class="px-2 -ml-2 rounded-lg" />
                <x-badge color="orange">Alpha</x-badge>
            </div>

            <x-spacer />

            <x-dropdown id="dropdown-menu" position="bottom-end" class="mr-2 sm:hidden">
                <x-button variant="subtle" size="sm" icon="o-ellipsis-vertical" />
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

            {{-- @auth
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
                            <x-menu.item wire:navigate href="/logout" icon="l-log-out">{{ __('Logout') }}</x-menu.item>
                        </x-menu.group>
                    </x-menu>
                </x-dropdown>
            @else
                <x-button wire:navigate :href="route('login')" variant="outline" size="sm" class="ml-2">
                    {{ __('Login') }}
                </x-button>
            @endauth --}}
        </x-navbar>
    </x-header>

    <x-main container class="max-w-7xl">
        {{ $slot }}
    </x-main>
</x-page>
