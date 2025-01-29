@props([
    'transition' => false,
    'expanded' => false,
])

@aware([
    'transition' => $transition,
    'expanded' => $expanded,
])

<div x-show="isAccordionOpen" {{ $attributes->merge(['x-collapse' => $transition]) }} data-accordion-content>
    <div {{ $attributes->class('pt-2 text-sm text-zinc-500 dark:text-zinc-300')->merge(['x-cloak' => !$expanded]) }}>
        {{ $slot }}
    </div>
</div>
