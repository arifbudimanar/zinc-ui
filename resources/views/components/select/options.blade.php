@props([
    'position' => 'bottom-start',
    'offset' => 6,
])

@php
    $classes = ZincUi::classes()
        ->add('z-20 p-[.3125rem] rounded-lg shadow-xs overflow-y-auto')
        ->add('border border-zinc-200 dark:border-zinc-600')
        ->add('bg-white dark:bg-zinc-700')
        ->add('[:where(&)]:min-w-48 [:where(&)]:w-full [:where(&)]:max-h-[20rem]');
@endphp

<div {{ $attributes->class($classes) }}
    x-show="isSelectOpen" x-cloak
    x-anchor.{{ $position }}.offset.{{ $offset }}="$refs.select"
    x-trap.noautofocus="isSelectOpen"
    x-on:click.outside="closeSelect"
    x-on:click.stop="isSelectOpen"
    x-init="() => $el.style.width = $el.closest('[data-select]').querySelector('[data-select-button]')?.offsetWidth + 'px'"
    x-resize.window="() => $el.style.width = $el.closest('[data-select]').querySelector('[data-select-button]')?.offsetWidth + 'px'"
    data-options>
    {{ $slot }}
</div>
