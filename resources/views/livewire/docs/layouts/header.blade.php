<div class="space-y-16">
    <div>
        <x-heading size="xl" level="1" class="!mb-4">
            Header
        </x-heading>

        <x-subheading size="lg" class="mb-6">
            A full-width top navigation layout for your application.
        </x-subheading>

        <x-button href="{{ route('demo.header') }}" size="sm" icon="o-arrows-pointing-out" target="_blank">
            Fullscreen
        </x-button>

        <x-card class="mt-3 overflow-hidden !p-0">
            <img src="{{ asset('images/demo/header-light.png') }}" alt="Header Light" class="block dark:hidden">
            <img src="{{ asset('images/demo/header-dark.png') }}" alt="Header Dark" class="hidden dark:block">
        </x-card>
    </div>

    <div>
        <x-heading size="lg" level="1" class="!mb-4">
            Secondary sidebar
        </x-heading>

        <x-subheading size="lg" class="mb-6">
            Use a sidebar for secondary navigation.
        </x-subheading>

        <x-button href="{{ route('demo.header-sidebar') }}" size="sm" icon="o-arrows-pointing-out" target="_blank">
            Fullscreen
        </x-button>

        <x-card class="mt-3 overflow-hidden !p-0">
            <img src="{{ asset('images/demo/header-sidebar-light.png') }}" alt="Header Sidebar Light"
                class="block dark:hidden">
            <img src="{{ asset('images/demo/header-sidebar-dark.png') }}" alt="Header Sidebar Dark"
                class="hidden dark:block">
        </x-card>
    </div>

    <div>
        <x-heading size="lg" level="1" class="!mb-4">
            Without header
        </x-heading>

        <x-subheading size="lg" class="mb-6">
            Full width layout without header.
        </x-subheading>

        <x-button href="{{ route('demo.header-sidebar') }}" size="sm" icon="o-arrows-pointing-out" target="_blank">
            Fullscreen
        </x-button>

        <x-card class="mt-3 overflow-hidden !p-0">
            <img src="{{ asset('images/demo/without-header-light.png') }}" alt="Without Header Light"
                class="block dark:hidden">
            <img src="{{ asset('images/demo/without-header-dark.png') }}" alt="Without Header Dark"
                class="hidden dark:block">
        </x-card>
    </div>
</div>
