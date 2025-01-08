@props([
    'heading' => null,
    'transition' => false,
    'expanded' => false,
])

@php
    $classes = 'block pt-4 pb-4 border-b first:pt-0 last:pb-0 last:border-b-0 border-zinc-800/10 dark:border-white/10';
@endphp

@if ($heading)
    <div {{ $attributes->merge(['class' => $classes]) }} x-data="{ isAccordionOpen: {{ $expanded ? 'true' : 'false' }} }" data-accordion-item>
        <x-accordion.heading>
            {{ $heading }}
        </x-accordion.heading>

        <x-accordion.content>
            {{ $slot }}
        </x-accordion.content>
    </div>
@else
    <div {{ $attributes->merge(['class' => $classes]) }} x-data="{ isAccordionOpen: {{ $expanded ? 'true' : 'false' }} }" data-accordion-item>
        {{ $slot }}
    </div>
@endif
