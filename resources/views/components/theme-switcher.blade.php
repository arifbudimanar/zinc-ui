@props(['variant' => 'header'])

<div x-data="{
    theme: localStorage.theme,
    lightModeMessage: @js(__('Light mode applied.')),
    darkModeMessage: @js(__('Dark mode applied.')),
    systemModeMessage: @js(__('System preference applied.')),
    init() {
        window.addEventListener('storage', (event) => {
            if (event.key === 'theme') {
                this.theme = event.newValue;
                setThemeClass();
            }
        });
    },
    darkMode() {
        if (this.theme !== 'dark') {
            Toaster.success(this.darkModeMessage)
            this.theme = 'dark'
            localStorage.theme = 'dark'
            setThemeClass()
            window.dispatchEvent(new Event('storage'))
        }
    },
    lightMode() {
        if (this.theme !== 'light') {
            Toaster.success(this.lightModeMessage)
            this.theme = 'light'
            localStorage.theme = 'light'
            setThemeClass()
            window.dispatchEvent(new Event('storage'))
        }
    },
    systemMode() {
        if (this.theme !== undefined) {
            Toaster.success(this.systemModeMessage)
            this.theme = undefined
            localStorage.removeItem('theme')
            setThemeClass()
            window.dispatchEvent(new Event('storage'))
        }
    },
}" {{ $attributes->whereStartsWith('class') }} id="theme-switcher">
    @if ($variant === 'header')
        <x-dropdown id="dropdown-theme-switcher-desktop" position="bottom-end" {{ $attributes }}>
            <x-button variant="subtle" size="sm" tooltip="Theme Preferences">
                <x-slot:iconLeading>
                    <x-icon name="o-moon" class="hidden size-5 dark:block" />
                    <x-icon name="o-sun" class="block size-5 dark:hidden" />
                </x-slot:iconLeading>
            </x-button>
            <x-navmenu>
                <x-navmenu.item icon="o-moon" :label="__('Dark Mode')" kbd="Alt+M" x-on:click="darkMode()"
                    class="whitespace-nowrap" />
                <x-navmenu.item icon="o-sun" :label="__('Light Mode')" kbd="Alt+L" x-on:click="lightMode()"
                    class="whitespace-nowrap" />
                <x-navmenu.item :label="__('System Preference')" kbd="Alt+P" x-on:click="systemMode()" class="whitespace-nowrap">
                    <x-slot:icon>
                        <x-icon name="o-computer-desktop" class="hidden mr-2 shrink-0 size-5 lg:block"
                            data-navmenu-icon />
                        <x-icon name="o-device-tablet" class="hidden mr-2 shrink-0 size-5 md:block lg:hidden"
                            data-navmenu-icon />
                        <x-icon name="o-device-phone-mobile" class="mr-2 shrink-0 size-5 md:hidden lg:hidden"
                            data-navmenu-icon />
                    </x-slot:icon>
                </x-navmenu.item>
            </x-navmenu>
        </x-dropdown>
    @endif
    @if ($variant === 'sidebar')
        <x-dropdown id="dropdown-theme-switcher-sidebar" position="top-start"
            {{ $attributes->merge(['class' => 'w-full']) }}>
            <x-navlist.item variant="outline" label="Theme Preferences">
                <x-slot:iconLeading>
                    <x-icon name="o-moon" class="hidden size-5 dark:flex" />
                    <x-icon name="o-sun" class="flex size-5 dark:hidden" />
                </x-slot:iconLeading>
            </x-navlist.item>

            <x-navmenu>
                <x-navmenu.item icon="o-moon" :label="__('Dark Mode')" x-on:click="darkMode()" kbd="Alt+M" />
                <x-navmenu.item icon="o-sun" :label="__('Light Mode')" x-on:click="lightMode()" kbd="Alt+L" />
                <x-navmenu.item :label="__('System Preference')" x-on:click="systemMode()" kbd="Alt+P">
                    <x-slot:icon>
                        <x-icon name="o-computer-desktop" class="hidden mr-2 shrink-0 size-5 lg:block"
                            data-navmenu-icon />
                        <x-icon name="o-device-tablet" class="hidden mr-2 shrink-0 size-5 md:block lg:hidden"
                            data-navmenu-icon />
                        <x-icon name="o-device-phone-mobile" class="mr-2 shrink-0 size-5 md:hidden lg:hidden"
                            data-navmenu-icon />
                    </x-slot:icon>
                </x-navmenu.item>
            </x-navmenu>
        </x-dropdown>
    @endif
</div>
