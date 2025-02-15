@props([
    'position' => 'bottom-start',
    'offset' => 6,
])

@aware([
    'position' => $position,
    'offset' => $offset,
])

<div role="menu"
    {{ $attributes->class('absolute z-20 [:where(&)]:min-w-48 w-full [:where(&)]:max-h-[20rem] p-[.3125rem] rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 overflow-y-auto') }}
    x-show="isSelectOpen" x-cloak
    x-anchor.{{ $position }}.offset.{{ $offset }}="$refs.select"
    x-trap.noautofocus="isSelectOpen"
    x-on:click.outside="closeSelect"
    x-on:keydown.escape="closeSelect"
    x-on:click.stop="isSelectOpen" data-options>
    {{ $slot }}
</div>
