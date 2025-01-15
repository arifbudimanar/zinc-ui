@props([
    'id' => null,
    'heading' => null,
    'position' => 'right-start',
    'offset' => -4,
    'variant' => 'default',
    'icon' => null,
])

@php
    $id = $id ?? 'submenu-' . Str::random(8);
@endphp

<x-dropdown {{ $attributes->merge(['class' => '!w-full']) }} :$id :$position :$offset
    x-on:mouseover.outside="closeDropdown" x-on:keydown.left="closeDropdown" data-menu-submenu>
    <x-menu.item :$variant :$icon x-on:keydown.right="openDropdown" x-on:mouseover="openDropdown"
        x-on:keydown.enter="toggleDropdown" x-on:click.stop="isDropdownOpen">
        {{ $heading }}

        <x-slot:suffix>
            <x-icon icon="o-chevron-right"
                class="shrink-0 pl-2 h-5 w-auto text-zinc-400 [[data-menu-item]:hover_&]:text-current" />
        </x-slot:suffix>
    </x-menu.item>

    <x-menu>
        {{ $slot }}
    </x-menu>
</x-dropdown>
