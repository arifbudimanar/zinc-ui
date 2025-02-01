@props([
    'active' => false,
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
])

@php
    $iconLeading = $icon ??= $iconLeading;
    $classes = ZincUi::classes()
        ->add('relative flex items-center gap-3 px-3 h-8 rounded-lg')
        ->add(
            $active
                ? 'text-zinc-800 dark:text-white hover:text-zinc-800 hover:dark:text-white hover:bg-zinc-100 hover:dark:bg-white/10'
                : 'text-zinc-500 dark:text-zinc-200 hover:text-zinc-800 hover:dark:text-white hover:bg-zinc-100 hover:dark:bg-white/10',
        )
        ->add($active ? 'after:absolute after:-bottom-3 after:inset-x-0 after:h-[2px] after:bg-zinc-800 after:dark:bg-white' : '');
@endphp

<x-button-or-link {{ $attributes->class($classes) }} data-navbar-item>
    <?php if (is_string($iconLeading) && $iconLeading != null): ?>
        <x-icon :name="$iconLeading" class="inline-flex size-5 shrink-0 items-center" />
    <?php else: ?>
        {{ $iconLeading }}
    <?php endif; ?>

    <div class="flex-1 whitespace-nowrap text-sm font-medium leading-none">
        {{ $slot }}
    </div>

    <?php if (is_string($iconTrailing) && $iconLeading != null): ?>
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
