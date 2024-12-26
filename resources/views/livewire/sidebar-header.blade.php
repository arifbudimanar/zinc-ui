<div>
    <x-heading size="xl" level="1">Good afternoon, Olivia</x-heading>

    <x-subheading size="lg" class="mb-6">Here's what's new today</x-subheading>

    <x-separator variant="subtle" />

    <div class="flex flex-col flex-wrap gap-1 mt-6">
        <div class="flex gap-1">
            <x-button wire:navigate :href="route('header')">Header</x-button>
            <x-button wire:navigate :href="route('header-sidebar')">Header with Sidebar</x-button>
        </div>
        <div class="flex gap-1">
            <x-button wire:navigate :href="route('sidebar')">Sidebar</x-button>
            <x-button wire:navigate :href="route('sidebar-header')">Sidebar with Header</x-button>
        </div>
        <div class="flex gap-1">
            <x-button wire:navigate :href="route('documentation')">Doc</x-button>
        </div>
    </div>
    <div class="min-h-screen">

    </div>
</div>
