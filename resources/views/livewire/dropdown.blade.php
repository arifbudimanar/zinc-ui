<x-card variant="subtle" class="space-y-4">
    <div class="max-w-lg space-y-2">
        <x-heading :level="1">Dropdown</x-heading>
        <x-subheading>
            A composable dropdown component that can handle both simple navigation menus as well as complex action menus
            with checkboxes, radios, and submenus.
        </x-subheading>
    </div>
    <x-card variant="subtle" class="flex flex-wrap gap-2">
        <x-dropdown position="bottom-start">
            <x-button icon="o-chevron-down">User Menu</x-button>
            <x-menu>
                <div class="px-2 py-1.5">
                    <x-subheading class="!text-xs">Sign in as</x-subheading>
                    <x-heading class="truncate max-w-48 !mt-1">arifbudimanarrosyid@gmail.com</x-heading>
                </div>

                <x-menu.group heading="Navigation">
                    <x-menu.item icon="o-rectangle-stack">Home</x-menu.item>
                    <x-menu.item icon="o-rectangle-stack">User Dashboard</x-menu.item>
                    <x-menu.item icon="o-rectangle-stack">Admin Dashboard</x-menu.item>
                </x-menu.group>
                <x-menu.item icon="o-user-circle">Account</x-menu.item>
                <x-menu.submenu heading="Settings" icon="o-cog-8-tooth">
                    <x-menu.item icon="o-language">Language</x-menu.item>
                    <x-menu.item icon="o-bell">Notification</x-menu.item>
                </x-menu.submenu>
                <x-menu.submenu heading="Theme Preferences">
                    <x-slot:icon>
                        <x-icon name="o-moon" class="hidden mr-2 shrink-0 size-5 dark:block" data-menu-item-icon />
                        <x-icon name="o-sun" class="block mr-2 shrink-0 size-5 dark:hidden" data-menu-item-icon />
                    </x-slot:icon>
                    <x-menu.item icon="o-moon">Dark Mode</x-menu.item>
                    <x-menu.item icon="o-sun">Light Mode</x-menu.item>
                    <x-menu.item icon="o-computer-desktop">System Preference</x-menu.item>
                </x-menu.submenu>
                <x-menu.group>
                    <x-menu.item variant="danger" icon="o-x-circle">Disable Admin Mode</x-menu.item>
                    <x-menu.item icon="l-log-out">Logout</x-menu.item>
                </x-menu.group>
            </x-menu>
        </x-dropdown>
        <x-dropdown position="bottom-end">
            <x-button iconTrailing="o-chevron-down">User Menu</x-button>
            <x-menu>
                <div class="px-2 py-1.5">
                    <x-subheading class="!text-xs">Sign in as</x-subheading>
                    <x-heading class="truncate max-w-48 !mt-1">Arif Budiman Arrosyid</x-heading>
                </div>
                <x-menu.group heading="Navigation">
                    <x-menu.item>Home</x-menu.item>
                    <x-menu.item>User Dashboard</x-menu.item>
                    <x-menu.item>Admin Dashboard</x-menu.item>
                </x-menu.group>
                <x-menu.item icon="o-user-circle">Account</x-menu.item>
                <x-menu.submenu heading="Settings">
                    <x-menu.group>
                        <x-menu.item>Language</x-menu.item>
                        <x-menu.item>Notification</x-menu.item>
                    </x-menu.group>
                </x-menu.submenu>
                <x-menu.submenu heading="Theme Preferences">
                    <x-menu.group>
                        <x-menu.item icon="o-moon">Dark Mode</x-menu.item>
                        <x-menu.item icon="o-sun">Light Mode</x-menu.item>
                        <x-menu.item icon="o-computer-desktop">System Preference</x-menu.item>
                    </x-menu.group>
                </x-menu.submenu>
                <x-menu.group>
                    <x-menu.item variant="danger">Disable Admin Mode</x-menu.item>
                    <x-menu.item>Logout</x-menu.item>
                </x-menu.group>
            </x-menu>
        </x-dropdown>
        <x-dropdown position="bottom-start">
            <x-button icon="o-chevron-down">User Navmenu</x-button>
            <x-navmenu>
                <div class="px-2 py-1.5">
                    <x-subheading class="!text-xs">Sign in as</x-subheading>
                    <x-heading class="truncate max-w-48 !mt-1">arifbudimanarrosyid@gmail.com</x-heading>
                </div>
                <x-navmenu.separator />
                <x-navmenu.item icon="o-key">Licenses</x-navmenu.item>
                <x-navmenu.item icon="o-user-circle">Account</x-navmenu.item>
                <x-navmenu.separator></x-navmenu.separator>
                <x-navmenu.item variant="danger" icon="o-x-circle">Disable Admin Mode</x-navmenu.item>
                <x-navmenu.item icon="l-log-out">Logout</x-navmenu.item>
            </x-navmenu>
        </x-dropdown>
        <x-dropdown position="bottom-end">
            <x-button iconTrailing="o-chevron-down">User Navmenu</x-button>
            <x-navmenu>
                <div class="px-2 py-1.5">
                    <x-subheading class="!text-xs">Sign in as</x-subheading>
                    <x-heading class="truncate max-w-48 !mt-1">Arif Budiman Arrosyid</x-heading>
                </div>
                <x-navmenu.separator />
                <x-navmenu.item indent>Licenses</x-navmenu.item>
                <x-navmenu.item icon="o-user-circle">Account</x-navmenu.item>
                <x-navmenu.separator></x-navmenu.separator>
                <x-navmenu.item variant="danger" icon="o-x-circle">Disable Admin Mode</x-navmenu.item>
                <x-navmenu.item indent>Logout</x-navmenu.item>
            </x-navmenu>
        </x-dropdown>
        <x-dropdown position="bottom-start">
            <x-button>
                <x-slot:icon>
                    <x-icon name="o-sun" class="size-5 shrink-0 dark:hidden" />
                    <x-icon name="o-moon" class="hidden size-5 shrink-0 dark:block" />
                </x-slot:icon>
            </x-button>
            <x-navmenu>
                <x-navmenu.item icon="o-moon" :label="__('Dark Mode')" kbd="Alt+M" x-on:click="darkMode()"
                    class="whitespace-nowrap" />
                <x-navmenu.item icon="o-sun" :label="__('Light Mode')" kbd="Alt+L" x-on:click="lightMode()"
                    class="whitespace-nowrap" />
                <x-navmenu.item icon="o-computer-desktop" :label="__('System Preference')" kbd="Alt+P" x-on:click="systemMode()"
                    class="whitespace-nowrap" />
            </x-navmenu>
        </x-dropdown>
        <x-button.group>
            <x-button icon="o-plus">
                Create
            </x-button>
            <x-dropdown position="bottom-end">
                <x-button icon="o-ellipsis-vertical" />
                <x-navmenu class="min-w-32">
                    <x-navmenu.item icon="o-archive-box">Archived</x-navmenu.item>
                    <x-navmenu.item icon="o-trash">Deleted</x-navmenu.item>
                </x-navmenu>
            </x-dropdown>
        </x-button.group>
    </x-card>
</x-card>
