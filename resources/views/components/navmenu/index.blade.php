@props([
    'position' => 'bottom-start',
    'offset' => 6,
])

@aware([
    'position' => $position,
    'offset' => $offset,
])

<div role="menu" {{ $attributes->class('z-20 [:where(&)]:min-w-48 p-1 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700') }}
    x-show="isDropdownOpen" x-cloak
    x-anchor.{{ $position }}.offset.{{ $offset }}="$refs.dropdown"
    x-trap.noautofocus.noreturn="isDropdownOpen"
    x-on:click.outside="closeDropdown"
    x-on:keydown.escape="closeDropdown"
    x-on:click.stop="isDropdownOpen" data-navmenu>
    {{ $slot }}
</div>
