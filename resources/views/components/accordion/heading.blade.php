@props(['expanded' => false])

@aware(['expanded' => $expanded])

@php
    $classes =
        'group/accordion-heading flex items-center w-full text-left text-sm font-medium justify-between [&>svg]:ml-6 text-zinc-800 dark:text-white cursor-pointer';
@endphp

<button {{ $attributes->merge(['class' => $classes, 'type' => 'button']) }}
    x-on:click="isAccordionOpen = !isAccordionOpen" data-accordion-heading>
    <span class="flex-1">
        {{ $slot }}
    </span>
    <x-icon name="o-chevron-down" x-show="!isAccordionOpen" {{ $attributes->merge(['x-cloak' => $expanded == true]) }}
        class="size-5 shrink-0 text-zinc-300 dark:text-zinc-400 group-hover/accordion-heading:text-zinc-800 dark:group-hover/accordion-heading:text-white"></x-icon>
    <x-icon name="o-chevron-up" x-show="isAccordionOpen" {{ $attributes->merge(['x-cloak' => $expanded == false]) }}
        class="size-5 shrink-0 text-zinc-300 dark:text-zinc-400 group-hover/accordion-heading:text-zinc-800 dark:group-hover/accordion-heading:text-white"></x-icon>
</button>
