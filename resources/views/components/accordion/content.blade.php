@props(['transition' => false, 'expanded' => false])

@aware(['transition' => $transition, 'expanded' => $expanded])

<div x-show="isAccordionOpen" data-accordion-content @if ($transition) x-collapse @endif
    {{ $attributes->merge(['x-cloak' => $expanded == false]) }}>
    <div {{ $attributes->merge(['class' => 'pt-2 text-sm text-zinc-500 dark:text-zinc-300']) }}>
        {{ $slot }}
    </div>
</div>
