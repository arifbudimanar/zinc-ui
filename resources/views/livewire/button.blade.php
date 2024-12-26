<x-card variant="subtle" class="space-y-4">
    <div class="max-w-lg space-y-2">
        <x-heading :level="1">Button</x-heading>
        <x-subheading>
            A powerful and composable button component for your application.
        </x-subheading>
    </div>
    <div>
        <x-button>Button</x-button>
    </div>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">Variant</x-heading>
        <x-subheading>
            Use the variant prop to change the visual style of the button.
        </x-subheading>
    </div>
    <div class="flex flex-wrap gap-2 overflow-x-auto">
        <x-button variant="primary">Primary</x-button>
        <x-button variant="filled">Filled</x-button>
        <x-button variant="outline">Outline</x-button>
        <x-button variant="danger">Danger</x-button>
        <x-button variant="ghost">Ghost</x-button>
        <x-button variant="subtle">Subtle</x-button>
    </div>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">Size</x-heading>
        <x-subheading>
            The default button size works great for most cases, but here are some additional size options for unique
            situations.
        </x-subheading>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <x-button size="base">Base</x-button>
        <x-button size="sm">Small</x-button>
        <x-button size="xs">Xtra small</x-button>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <x-button size="base" icon="o-minus-circle">Base</x-button>
        <x-button size="sm" icon="o-minus-circle">Small</x-button>
        <x-button size="xs" icon="o-minus-circle">Xtra small</x-button>
    </div>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">Icons</x-heading>
        <x-subheading>
            Automatically sized and styled icons for your buttons.
        </x-subheading>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <x-button icon="o-minus-circle" />
        <x-button iconLeading="o-minus-circle">Icon leading</x-button>
        <x-button iconTrailing="o-minus-circle">Icon trailing</x-button>
        <x-button variant="subtle" icon="o-minus-circle" />
    </div>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">As</x-heading>
        <x-subheading>
            Button can be a link, button or div.
        </x-subheading>
    </div>

    <div class="max-w-md space-y-2">
        <x-button href="/" wire:navigate>Link</x-button>
        <x-button>Button</x-button>
        <x-button as="div">Div</x-button>
    </div>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">Width</x-heading>
        <x-subheading>
            A button that spans the full width of the container.
        </x-subheading>
    </div>
    <div class="max-w-md space-y-2">
        <x-button class="w-full">Full width</x-button>
        <x-button icon="o-minus-circle" class="w-full">With icon</x-button>
        <x-button class="!justify-start w-full">Justify Start</x-button>
        <x-button icon="o-minus-circle" class="!justify-start w-full">With icon</x-button>
    </div>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">Button Groups</x-heading>
        <x-subheading>
            Fuse related buttons into a group with shared borders.
        </x-subheading>
    </div>
    <div class="space-y-2">
        <x-button.group class="flex-wrap">
            <x-button icon="o-minus-circle">Base</x-button>
            <x-button icon="o-minus-circle">Base</x-button>
            <x-button icon="o-minus-circle">Base</x-button>
        </x-button.group>
        <x-button.group class="flex-wrap">
            <x-button size="sm" icon="o-minus-circle">Small</x-button>
            <x-button size="sm" icon="o-minus-circle">Small</x-button>
            <x-button size="sm" icon="o-minus-circle">Small</x-button>
        </x-button.group>
        <x-button.group class="flex-wrap">
            <x-button size="xs" icon="o-minus-circle">Xtra small</x-button>
            <x-button size="xs" icon="o-minus-circle">Xtra small</x-button>
            <x-button size="xs" icon="o-minus-circle">Xtra small</x-button>
        </x-button.group>
    </div>
</x-card>
