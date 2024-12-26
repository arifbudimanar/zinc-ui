<x-card variant="subtle" class="space-y-4">
    <div class="max-w-lg space-y-2">
        <x-heading :level="1">Tooltip</x-heading>
        <x-subheading>
            Provide additional information when users hover over or focus on an element. Enhance user understanding
            without
            cluttering the UI.
        </x-subheading>
    </div>
    <div class="flex gap-2">
        <x-tooltip content="Tooltip content">
            <x-button>Short Tooltip</x-button>
        </x-tooltip>
        <x-tooltip
            content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam numquam aliquid eum soluta earum esse sunt illum voluptates explicabo fuga.">
            <x-button>Long Tooltip</x-button>
        </x-tooltip>
    </div>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">Position</x-heading>
        <x-subheading>Position tooltips around the element for optimal visibility. Choose from top, right, bottom, or
            left.</x-subheading>
    </div>
    <x-button.group>
        <x-tooltip position="top" content="Top tooltip">
            <x-button>Top</x-button>
        </x-tooltip>
        <x-tooltip position="top-start" content="Top start tooltip">
            <x-button>Top start</x-button>
        </x-tooltip>
        <x-tooltip position="top-end" content="Top end tooltip">
            <x-button>Top end</x-button>
        </x-tooltip>
    </x-button.group>
    <x-button.group>
        <x-tooltip position="bottom" content="Bottom tooltip">
            <x-button>Bottom</x-button>
        </x-tooltip>
        <x-tooltip position="bottom-start" content="Bottom start tooltip">
            <x-button>Bottom start</x-button>
        </x-tooltip>
        <x-tooltip position="bottom-end" content="Bottom end tooltip">
            <x-button>Bottom end</x-button>
        </x-tooltip>
    </x-button.group>
    <x-button.group>
        <x-tooltip position="left" content="Left tooltip">
            <x-button>Left</x-button>
        </x-tooltip>
        <x-tooltip position="left-start" content="Left start tooltip">
            <x-button>Left start</x-button>
        </x-tooltip>
        <x-tooltip position="left-end" content="Left end tooltip">
            <x-button>Left end</x-button>
        </x-tooltip>
    </x-button.group>
    <x-button.group>
        <x-tooltip position="right" content="Right tooltip">
            <x-button>Right</x-button>
        </x-tooltip>
        <x-tooltip position="right-start" content="Right start tooltip">
            <x-button>Right start</x-button>
        </x-tooltip>
        <x-tooltip position="right-end" content="Right end tooltip">
            <x-button>Right end</x-button>
        </x-tooltip>
    </x-button.group>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">Button shorthand</x-heading>
        <x-subheading>Make your markup more concise by providing the tooltip prop to the button component
            directly.</x-subheading>
    </div>
    <div class="flex gap-2">
        <x-button tooltip="Tooltip">Tooltip</x-button>
        <x-button tooltip="Top position tooltip" tooltipPosition="top">Position</x-button>
        <x-button tooltip="12px offset tooltip" tooltipPosition="top" tooltipOffset="12">Offset</x-button>
        <x-button tooltip="You can toggle this tooltip with" tooltipKbd="Ctrl + Alt + L"
            x-on:keydown.ctrl.alt.l.window="toogleTooltip">Kbd</x-button>
    </div>

    <div class="max-w-lg space-y-2">
        <x-heading :level="2">Disabled button</x-heading>
        <x-subheading>
            Tooltip on disabled button will be displayed on hover, but the button will not be clickable.
        </x-subheading>
    </div>
    <div class="flex">
        <x-button tooltip="Tooltip" disabled>Disabled</x-button>
    </div>
</x-card>
