@props([
    'transition' => false,
    'expanded' => false,
])

@aware([
    'transition' => $transition,
    'expanded' => $expanded,
])

<div x-show="isAccordionOpen" <?php if ($transition): ?> x-collapse <?php endif; ?> data-accordion-content>
    <div {{ $attributes->class('pt-2 text-sm text-zinc-500 dark:text-zinc-300')->merge(['x-cloak' => !$expanded]) }}>
        {{ $slot }}
    </div>
</div>
