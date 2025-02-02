@props([
    'id' => null,
    'position' => 'bottom-start',
    'offset' => 6,
])

@php
    $id = $id ?? 'dropdown-' . Str::random(8);
@endphp

<div id="{{ $id }}" {{ $attributes->class('w-fit') }} x-data="{
    isDropdownOpen: false,
    openDropdown() {
        this.isDropdownOpen = true;
    },
    toggleDropdown() {
        this.isDropdownOpen = !this.isDropdownOpen;
    },
    closeDropdown() {
        this.isDropdownOpen = false;
    },
}" x-ref="dropdown"
    x-on:click="toggleDropdown"
    x-on:keydown.down.prevent="$focus.next()"
    x-on:keydown.up.prevent="$focus.previous()"
    x-on:keydown.escape="closeDropdown" data-dropdown>
    {{ $slot }}
</div>
