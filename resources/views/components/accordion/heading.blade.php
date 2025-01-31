@props([
    'expanded' => false,
])

@aware([
    'expanded' => $expanded,
])

@php
    $classes = 'group flex w-full cursor-pointer items-center justify-between text-left text-sm font-medium text-zinc-800 dark:text-white [&>svg]:ml-6';
    $iconClasses = 'size-5 shrink-0 text-zinc-300 group-hover:text-zinc-800 dark:text-zinc-400 dark:group-hover:text-white';
@endphp

<button type="button" {{ $attributes->class($classes) }}
    x-on:click="isAccordionOpen = !isAccordionOpen" data-accordion-heading>
    <span class="flex-1">
        {{ $slot }}
    </span>
    <x-icon name="o-chevron-down" :attributes="$attributes->class($iconClasses)->merge(['x-cloak' => $expanded])"
        x-show="!isAccordionOpen" />
    <x-icon name="o-chevron-up" :attributes="$attributes->class($iconClasses)->merge(['x-cloak' => !$expanded])"
        x-show="isAccordionOpen" />
</button>
