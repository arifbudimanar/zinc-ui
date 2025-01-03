@props([
    'position' => 'bottom',
    'offset' => 8,
    'content' => null,
    'kbd' => null,
])

@aware([
    'position' => $position,
    'offset' => $offset,
    'content' => $content,
    'kbd' => $kbd,
])

@php
    $classes =
        'z-30 relative py-2 px-2.5 max-w-64 rounded-md text-xs text-white font-medium bg-zinc-800 dark:bg-zinc-700 dark:border dark:border-white/10 p-0 overflow-visible';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} x-show="isTooltipOpen" x-cloak x-transition
    x-anchor.{{ $position }}.offset.{{ $offset }}="$refs.tooltip" data-tooltip-content>
    {{ $content ?? $slot }}

    @if ($kbd !== null)
        <x-kbd :label="$kbd" class="flex" />
    @endif
</div>
