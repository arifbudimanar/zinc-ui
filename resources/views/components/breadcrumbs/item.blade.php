@props([
    'href' => null,
    'separator' => 'chevron-right',
    'icon' => null,
])

@aware(['separator' => $separator])

<div class="group flex items-center text-sm font-medium [&_[data-dropdown]]:-mx-1.5" data-breadcrumbs-item>
    <?php if ($href): ?>
        <a {{ $attributes->class('text-zinc-800 dark:text-white hover:underline decoration-zinc-800/20 underline-offset-4') }}>
            <?php if ($icon): ?>
                <x-icon name="{{ $icon }}" class="size-5 shrink-0" />
            <?php else: ?>
                {{ $slot }}
            <?php endif; ?>
        </a>
    <?php else: ?>
        <div {{ $attributes->merge(['class' => 'text-gray-500 dark:text-white/80']) }}>
            <?php if ($icon): ?>
                <x-icon name="{{ $icon }}" class="size-5 shrink-0" />
            <?php else: ?>
                {{ $slot }}
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($separator === 'chevron-right'): ?>
        <x-icon name="o-chevron-right"
            class="mx-2 size-4 shrink-0 text-zinc-300 group-last/breadcrumb:hidden dark:text-white/80" />
    <?php elseif ($separator === 'slash'): ?>
        <x-icon name="o-slash"
            class="mx-2 size-4 shrink-0 text-zinc-300 group-last/breadcrumb:hidden dark:text-white/80" />
    <?php endif; ?>
</div>
