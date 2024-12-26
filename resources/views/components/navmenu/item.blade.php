@props([
    'variant' => 'default',
    'disabled' => false,
    'indent' => false,
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
        'danger' => 'group flex items-center px-2 py-2 lg:py-1.5 w-full focus:outline-none rounded-md
            text-left text-sm font-medium disabled:text-zinc-400 text-zinc-800 dark:text-white
            hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-400/20 dark:hover:text-red-400
            focus:text-red-600 focus:bg-red-50 dark:focus:bg-red-400/20 dark:focus:text-red-400
            [&_[data-navmenu-icon]]:text-zinc-400 dark:[&_[data-navmenu-icon]]:text-white/60
            [&:hover_[data-navmenu-icon]]:text-current [&:focus_[data-navmenu-icon]]:text-current',
        'default' => 'group flex items-center px-2 py-2 lg:py-1.5 w-full focus:outline-none rounded-md
            text-left text-sm font-medium disabled:text-zinc-400 text-zinc-800 dark:text-white
            hover:bg-zinc-50 hover:dark:bg-zinc-600
            focus:bg-zinc-50 focus:dark:bg-zinc-600
            [&_[data-navmenu-icon]]:text-zinc-400 dark:[&_[data-navmenu-icon]]:text-white/60
            [&:hover_[data-navmenu-icon]]:text-current [&:focus_[data-navmenu-icon]]:text-current',
    ][$variant];
@endphp

<x-button-or-link {{ $attributes->merge(['class' => $variantClass]) }} data-navmenu-item>
    @if ($indent)
        <div class="w-7"></div>
    @endif

    @if (is_string($icon) && $icon !== '')
        <x-icon :$icon class="mr-2 shrink-0 size-5" data-navmenu-icon />
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
