@props([
    'variant' => 'filled',
    'active' => false,
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
])

@aware(['variant' => $variant])

@php
    $iconLeading = $icon ??= $iconLeading;
    $classes = ZincUi::classes()
        ->add('relative flex items-center w-full h-10 lg:h-8 gap-3 px-2.5 lg:px-3 py-0 my-px rounded-lg text-left')
        ->add(
            // Background ...
            $active
                ? match ($variant) {
                    'filled' => 'bg-zinc-800/5 dark:bg-white/10',
                    'outline' => 'bg-white dark:bg-white/10',
                }
                : 'hover:bg-zinc-100 hover:dark:bg-white/10',
        )
        ->add(
            // Text ...
            $active
                ? match ($variant) {
                    'filled' => 'text-zinc-800 dark:text-zinc-100 hover:text-zinc-800 hover:dark:text-zinc-100',
                    'outline' => 'text-zinc-800 dark:text-zinc-100 hover:text-zinc-800 hover:dark:text-zinc-100',
                }
                : 'text-zinc-500 dark:text-white/80 hover:text-zinc-800 hover:dark:text-white',
        )
        ->add(
            // Border ...
            $active
                ? match ($variant) {
                    'filled' => 'border-none',
                    'outline' => 'border border-zinc-200 dark:border-white/10',
                }
                : 'border border-transparent',
        );
@endphp

<x-button-or-link :attributes="$attributes->class($classes)" data-navlist-item>
    <?php if (is_string($iconLeading)): ?>
        <x-icon :name="$iconLeading" class="inline-flex size-5 shrink-0 items-center" />
    <?php else: ?>
        {{ $iconLeading }}
    <?php endif; ?>

    <div class="flex-1 whitespace-nowrap text-sm font-medium leading-none">
        {{ $slot }}
    </div>

    <?php if (is_string($iconTrailing)): ?>
        <x-icon :name="$iconTrailing" class="inline-flex size-5 shrink-0 items-center" />
    <?php else: ?>
        {{ $iconTrailing }}
    <?php endif; ?>

    <?php if ($badge): ?>
        <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="!px-1 !py-0.5">
            {{ $badge }}
        </x-badge>
    <?php endif; ?>
</x-button-or-link>
