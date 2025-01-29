@props([
    'expanded' => false,
])

@aware([
    'expanded' => $expanded,
])

<button type="button"
    {{ $attributes->class('group/accordion-heading flex w-full cursor-pointer items-center justify-between text-left text-sm font-medium text-zinc-800 dark:text-white [&>svg]:ml-6') }}
    x-on:click="isAccordionOpen = !isAccordionOpen" data-accordion-heading>
    <span class="flex-1">
        {{ $slot }}
    </span>
    <x-icon name="o-chevron-down" :attributes="$attributes
        ->class('size-5 shrink-0 text-zinc-300 group-hover/accordion-heading:text-zinc-800 dark:text-zinc-400 dark:group-hover/accordion-heading:text-white')
        ->merge(['x-cloak' => $expanded])"
        x-show="!isAccordionOpen" />
    <x-icon name="o-chevron-up" :attributes="$attributes
        ->class('size-5 shrink-0 text-zinc-300 group-hover/accordion-heading:text-zinc-800 dark:text-zinc-400 dark:group-hover/accordion-heading:text-white')
        ->merge(['x-cloak' => !$expanded])"
        x-show="isAccordionOpen" />
</button>
