@props([
    'position' => 'bottom-start',
    'offset' => 6,
])

@aware([
    'position' => $position,
    'offset' => $offset,
])

<div role="menu" {{ $attributes->class('z-20 min-w-48 p-1 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 focus:outline-none') }}
    x-show="isDropdownOpen" x-transition x-cloak
    x-anchor.{{ $position }}.offset.{{ $offset }}="$refs.dropdown"
    x-trap.noautofocus="isDropdownOpen"
    x-on:click.outside="closeDropdown"
    x-on:keydown.escape="closeDropdown"
    x-on:click.stop="isDropdownOpen" data-menu>
    {{ $slot }}
</div>
