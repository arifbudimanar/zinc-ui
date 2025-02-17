@props([
    'position' => 'bottom',
    'offset' => 6,
])

@aware([
    'position' => $position,
    'offset' => $offset,
])

@php
    $classes = ZincUi::classes()
        ->add('z-20 p-[.3125rem] rounded-lg shadow-sm overflow-y-auto')
        ->add('border border-zinc-200 dark:border-zinc-600')
        ->add('bg-white dark:bg-zinc-700')
        ->add('[:where(&)]:min-w-48 w-full [:where(&)]:max-h-[20rem]');
@endphp

<div {{ $attributes->class($classes) }}
    x-show="isSelectOpen" x-cloak
    x-anchor.{{ $position }}.offset.{{ $offset }}="$refs.select"
    x-trap.noautofocus="isSelectOpen"
    x-on:click.outside="closeSelect"
    x-on:keydown.escape="closeSelect"
    x-on:click.stop="isSelectOpen" data-options>
    {{ $slot }}
</div>
