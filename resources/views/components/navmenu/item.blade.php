@props([
    'href' => null,
    'variant' => 'default',
    'indent' => false,
    'suffix' => null,
    'icon' => null,
    'kbd' => null,
])

@php
    if ($kbd) {
        $suffix = $kbd;
    }

    $classes = ZincUi::classes()
        ->add('group flex items-center px-2 py-2 lg:py-1.5 w-full focus:outline-none rounded-md')
        ->add('text-left text-sm font-medium text-zinc-800 dark:text-white')
        ->add('disabled:text-zinc-400 disabled:dark:text-white/60 disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none')
        ->add(
            match ($variant) {
                'default' => 'hover:bg-zinc-50 hover:dark:bg-zinc-600 focus:bg-zinc-50 focus:dark:bg-zinc-600',
                'danger' => 'hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-400/20 dark:hover:text-red-400 focus:text-red-600 focus:bg-red-50 dark:focus:bg-red-400/20 dark:focus:text-red-400',
            },
        )->add('[&_[data-navmenu-icon]]:text-zinc-400 dark:[&_[data-navmenu-icon]]:text-white/60
            [&:hover_[data-navmenu-icon]]:text-current [&:focus_[data-navmenu-icon]]:text-current');
@endphp

<x-button-or-link {{ $attributes->merge(['class' => $classes]) }} data-navmenu-item>
    <?php if ($indent): ?>
        <div class="w-7"></div>
    <?php endif; ?>

    <?php if (is_string($icon) && $icon !== ''): ?>
        <x-icon :$icon class="mr-2 size-5 shrink-0" data-navmenu-icon />
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
