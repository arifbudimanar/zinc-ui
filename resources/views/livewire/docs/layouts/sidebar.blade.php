<div class="space-y-16">
    <div>
        <x-heading size="xl" level="1" class="!mb-4">
            Sidebar
        </x-heading>

        <x-subheading size="lg" class="mb-6">
            Use a sidebar navigation layout to keep your application content front and center.
        </x-subheading>

        <x-button href="{{ route('demo.sidebar') }}" size="sm" icon="o-arrows-pointing-out" target="_blank">
            Fullscreen
        </x-button>

        <x-card class="mt-3 overflow-hidden !p-0">
            <img src="{{ asset('images/demo/sidebar-light.png') }}" alt="Sidebar Light" class="block dark:hidden">
            <img src="{{ asset('images/demo/sidebar-dark.png') }}" alt="Sidebar Dark" class="hidden dark:block">
        </x-card>
    </div>

    <div>
        <x-heading size="lg" level="1" class="!mb-4">
            Secondary header
        </x-heading>

        <x-subheading size="lg" class="mb-6">
            Use a top header for secondary navigation.
        </x-subheading>

        <x-button href="{{ route('demo.sidebar-header') }}" size="sm" icon="o-arrows-pointing-out" target="_blank">
            Fullscreen
        </x-button>

        <x-card class="mt-3 overflow-hidden !p-0">
            <img src="{{ asset('images/demo/sidebar-header-light.png') }}" alt="Sidebar Header Light"
                class="block dark:hidden">
            <img src="{{ asset('images/demo/sidebar-header-dark.png') }}" alt="Sidebar Header Dark"
                class="hidden dark:block">
        </x-card>
    </div>
</div>
