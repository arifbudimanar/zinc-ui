@props([
    'transition' => false,
    'expanded' => false,
])

@aware([
    'transition' => $transition,
    'expanded' => $expanded,
])

<div x-show="isAccordionOpen" @if ($transition) x-collapse @endif data-accordion-content>
    <div {{ $attributes->class('pt-2 text-sm text-zinc-500 dark:text-zinc-300')->merge(['x-cloak' => !$expanded]) }}>
        {{ $slot }}
    </div>
</div>
