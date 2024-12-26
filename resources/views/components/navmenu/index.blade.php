@props([
    'position' => 'bottom',
    'offset' => 6,
])

@aware([
    'position' => $position,
    'offset' => $offset,
])

@php
    $classes =
        'z-20 [:where(&)]:min-w-48 p-1 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} x-show="isDropdownOpen" x-trap.noautofocus="isDropdownOpen" x-cloak
    x-transition x-anchor.{{ $position }}.offset.{{ $offset }}="$refs.dropdown"
    x-on:click.outside="closeDropdown" x-on:keydown.escape="closeDropdown" x-on:click.stop="isDropdownOpen" role="menu"
    data-navmenu>
    {{ $slot }}
</div>
