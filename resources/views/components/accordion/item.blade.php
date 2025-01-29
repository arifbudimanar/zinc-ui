@props([
    'heading' => null,
    'transition' => false,
    'expanded' => false,
])

@aware([
    'transition' => $transition,
    'expanded' => $expanded,
])

<div {{ $attributes->class('block border-b border-zinc-800/10 pb-4 pt-4 first:pt-0 last:border-b-0 last:pb-0 dark:border-white/10') }}
    x-data="{ isAccordionOpen: {{ $expanded ? 'true' : 'false' }} }"
    data-accordion-item>
    @if ($heading)
        <x-accordion.heading>
            {{ $heading }}
        </x-accordion.heading>

        <x-accordion.content>
            {{ $slot }}
        </x-accordion.content>
    @else
        {{ $slot }}
    @endif
</div>
