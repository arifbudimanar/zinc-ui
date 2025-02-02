@props([
    'variant' => 'default',
    'suffix' => null,
    'icon' => null,
    'kbd' => null,
])

@php
    if ($kbd) {
        $suffix = $kbd;
    }

    $classes = ZincUi::classes()
        ->add('flex items-center px-2 py-1.5 w-full focus:outline-none rounded-md disabled:opacity-50')
        ->add('text-left text-sm font-medium text-zinc-800 dark:text-white')
        ->add(
            match ($variant) {
                'default' => 'hover:bg-zinc-50 hover:dark:bg-zinc-600 focus:bg-zinc-50 focus:dark:bg-zinc-600',
                'danger' => 'hover:bg-red-50 hover:dark:bg-red-400/20 focus:bg-red-50 focus:dark:bg-red-400/20 hover:text-red-600 hover:dark:text-red-400 focus:text-red-600 focus:dark:text-red-400',
            },
        )
        ->add('[&_[data-menu-item-icon]]:text-zinc-400 dark:[&_[data-menu-item-icon]]:text-white/60 [&:hover_[data-menu-item-icon]]:text-current [&:focus_[data-menu-item-icon]]:text-current');
@endphp

<x-button-or-link :attributes="$attributes->class($classes)" data-menu-item :data-menu-item-has-icon="!!$icon">
    <?php if (is_string($icon) && $icon !== ''): ?>
        <x-icon :$icon class="mr-2 size-5 shrink-0" data-menu-item-icon />
    <?php elseif ($icon == null): ?>
        <div class="hidden w-7 [[data-menu]:has(>[data-menu-item-has-icon])_&]:block"></div>
   <?php else: ?>
        {{ $icon }}
    <?php endif; ?>

    {{ $slot }}

    <?php if (is_string($suffix) && $suffix != ''): ?>
        <div class="ml-auto">
            <x-kbd class="ml-2 hidden opacity-50 lg:block">
                {{ $suffix }}
            </x-kbd>
        </div>
   <?php else: ?>
        <div class="ml-auto">
            {{ $suffix }}
        </div>
    <?php endif; ?>
</x-button-or-link>
