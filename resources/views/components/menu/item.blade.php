@props([
    'variant' => 'default',
    'suffix' => null,
    'value' => null,
    'icon' => null,
    'label' => null,
    'kbd' => null,
])

@php
    if ($kbd) {
        $suffix = $kbd;
    }

    $variantClass = [
        'danger' => 'flex items-center px-2 py-1.5 w-full focus:outline-none rounded-md
            text-left text-sm font-medium [&[disabled]]:opacity-50 text-zinc-800 dark:text-white
            hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-400/20 dark:hover:text-red-400
            focus:text-red-600 focus:bg-red-50 dark:focus:bg-red-400/20 dark:focus:text-red-400
            [&_[data-menu-item-icon]]:text-zinc-400 dark:[&_[data-menu-item-icon]]:text-white/60
            [&:hover_[data-menu-item-icon]]:text-current [&:focus_[data-menu-item-icon]]:text-current',
        'default' => 'flex items-center px-2 py-1.5 w-full focus:outline-none rounded-md
            text-left text-sm font-medium [&[disabled]]:opacity-50 text-zinc-800 dark:text-white
            hover:bg-zinc-50 hover:dark:bg-zinc-600 focus:bg-zinc-50 focus:dark:bg-zinc-600
            [&_[data-menu-item-icon]]:text-zinc-400 dark:[&_[data-menu-item-icon]]:text-white/60
            [&:hover_[data-menu-item-icon]]:text-current [&:focus_[data-menu-item-icon]]:text-current',
    ][$variant];

@endphp

<x-button-or-link {{ $attributes->merge(['class' => $variantClass]) }} data-menu-item :data-menu-item-has-icon="!!$icon">
    @if (is_string($icon) && $icon !== '')
        <x-icon :$icon class="mr-2 shrink-0 size-5" data-menu-item-icon />
    @elseif ($icon == null)
        <div class="w-7 hidden [[data-menu]:has(>[data-menu-item-has-icon])_&]:block"></div>
    @else
        {{ $icon }}
    @endif

    {{ $label ?? $slot }}

    @if ($suffix)
        @if (is_string($suffix))
            <div class="ml-auto">
                <x-kbd class="hidden ml-2 opacity-50 lg:block">
                    {{ $suffix }}
                </x-kbd>
            </div>
        @else
            <div class="ml-auto">
                {{ $suffix }}
            </div>
        @endif
    @endif
</x-button-or-link>
