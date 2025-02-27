@props(['variant' => 'header'])

<div id="theme-switcher" {{ $attributes->whereStartsWith('class') }}
    x-data="{
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
        toggleTheme() {
            if (this.theme === 'dark') {
                this.systemMode()
            } else if (this.theme === 'light') {
                this.darkMode()
            } else {
                this.lightMode()
            }
        }
    }">
    <?php if ($variant === 'header'): ?>
        <x-dropdown id="dropdown-theme-switcher-desktop" position="bottom-end" {{ $attributes }}>
            <x-tooltip position="bottom" offset="6">
                <x-tooltip.content class="whitespace-nowrap">
                    {{ __('Theme Preferences') }}
                </x-tooltip.content>

                <x-button variant="subtle" size="sm">
                    <x-slot:icon>
                        <x-icon name="o-moon" class="hidden size-5 dark:block" />
                        <x-icon name="o-sun" class="block size-5 dark:hidden" />
                    </x-slot:icon>
                </x-button>
            </x-tooltip>
            <x-navmenu>
                <x-navmenu.item icon="s-moon" kbd="Alt+M" x-on:click="darkMode()" class="whitespace-nowrap">
                    {{ __('Dark Mode') }}
                </x-navmenu.item>

                <x-navmenu.item icon="s-sun" kbd="Alt+L" x-on:click="lightMode()" class="whitespace-nowrap">
                    {{ __('Light Mode') }}
                </x-navmenu.item>

                <x-navmenu.item kbd="Alt+P" x-on:click="systemMode()" class="whitespace-nowrap">
                    <x-slot:icon>
                        <x-icon name="s-computer-desktop" class="hidden mr-2 shrink-0 size-5 lg:block"
                            data-navmenu-icon />
                        <x-icon name="s-device-tablet" class="hidden mr-2 shrink-0 size-5 md:block lg:hidden"
                            data-navmenu-icon />
                        <x-icon name="s-device-phone-mobile" class="mr-2 shrink-0 size-5 md:hidden lg:hidden"
                            data-navmenu-icon />
                    </x-slot:icon>
                    {{ __('System Preference') }}
                </x-navmenu.item>
            </x-navmenu>
        </x-dropdown>
    <?php elseif ($variant === 'sidebar'): ?>
        <x-dropdown id="dropdown-theme-switcher-sidebar" position="top-start"
            {{ $attributes->merge(['class' => 'w-full']) }}>
            <x-navlist.item variant="outline">
                <x-slot:icon>
                    <x-icon name="o-moon" class="hidden size-5 dark:flex" />
                    <x-icon name="o-sun" class="flex size-5 dark:hidden" />
                </x-slot:icon>
                {{ __('Theme Preferences') }}
            </x-navlist.item>

            <x-navmenu>
                <x-navmenu.item icon="s-moon" x-on:click="darkMode()" kbd="Alt+M">
                    {{ __('Dark Mode') }}
                </x-navmenu.item>

                <x-navmenu.item icon="s-sun" x-on:click="lightMode()" kbd="Alt+L">
                    {{ __('Light Mode') }}
                </x-navmenu.item>

                <x-navmenu.item x-on:click="systemMode()" kbd="Alt+P">
                    <x-slot:icon>
                        <x-icon name="s-computer-desktop" class="hidden mr-2 shrink-0 size-5 lg:block"
                            data-navmenu-icon />
                        <x-icon name="s-device-tablet" class="hidden mr-2 shrink-0 size-5 md:block lg:hidden"
                            data-navmenu-icon />
                        <x-icon name="s-device-phone-mobile" class="mr-2 shrink-0 size-5 md:hidden lg:hidden"
                            data-navmenu-icon />
                    </x-slot:icon>

                    {{ __('System Preference') }}
                </x-navmenu.item>
            </x-navmenu>
        </x-dropdown>
    <?php elseif ($variant === 'simple'): ?>
        <x-tooltip content="{{ __('Togle Theme Preferences') }}" {{ $attributes }}>
            <x-button variant="subtle" size="sm" x-on:click="toggleTheme()" {{ $attributes }}>
                <x-slot:icon>
                    <x-icon name="o-moon" class="hidden size-5 dark:flex" />
                    <x-icon name="o-sun" class="flex size-5 dark:hidden" />
                </x-slot:icon>
            </x-button>
        </x-tooltip>
    <?php endif; ?>
</div>
