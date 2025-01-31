@props([
    'as' => 'badge',
    'size' => 'base',
    'label' => null,
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'color' => 'zinc',
    'variant' => 'default',
    'inset' => null,
])

@php
    $iconLeading = $icon ??= $iconLeading;
    $classes = ZincUi::classes()
        ->add('inline-flex items-center font-medium whitespace-nowrap [print-color-adjust:exact]')
        ->add(
            // Color...
            match ($color) {
                'zinc'
                    => 'text-zinc-700 [&_button]:!text-zinc-700 dark:text-zinc-200 [&_button]:dark:!text-zinc-200 bg-zinc-400/15 dark:bg-zinc-400/40 [&:is(button)]:hover:bg-zinc-400/25 [&:is(button)]:hover:dark:bg-zinc-400/50',
                'red'
                    => 'text-red-700 [&_button]:!text-red-700 dark:text-red-200 [&_button]:dark:!text-red-200 bg-red-400/20 dark:bg-red-400/40 [&:is(button)]:hover:bg-red-400/30 [&:is(button)]:hover:dark:bg-red-400/50',
                'orange'
                    => 'text-orange-700 [&_button]:!text-orange-700 dark:text-orange-200 [&_button]:dark:!text-orange-200 bg-orange-400/20 dark:bg-orange-400/40 [&:is(button)]:hover:bg-orange-400/30 [&:is(button)]:hover:dark:bg-orange-400/50',
                'amber'
                    => 'text-amber-700 [&_button]:!text-amber-700 dark:text-amber-200 [&_button]:dark:!text-amber-200 bg-amber-400/25 dark:bg-amber-400/40 [&:is(button)]:hover:bg-amber-400/40 [&:is(button)]:hover:dark:bg-amber-400/50',
                'yellow'
                    => 'text-yellow-800 [&_button]:!text-yellow-800 dark:text-yellow-200 [&_button]:dark:!text-yellow-200 bg-yellow-400/25 dark:bg-yellow-400/40 [&:is(button)]:hover:bg-yellow-400/40 [&:is(button)]:hover:dark:bg-yellow-400/50',
                'lime'
                    => 'text-lime-800 [&_button]:!text-lime-800 dark:text-lime-200 [&_button]:dark:!text-lime-200 bg-lime-400/25 dark:bg-lime-400/40 [&:is(button)]:hover:bg-lime-400/35 [&:is(button)]:hover:dark:bg-lime-400/50',
                'green'
                    => 'text-green-800 [&_button]:!text-green-800 dark:text-green-200 [&_button]:dark:!text-green-200 bg-green-400/20 dark:bg-green-400/40 [&:is(button)]:hover:bg-green-400/30 [&:is(button)]:hover:dark:bg-green-400/50',
                'emerald'
                    => 'text-emerald-800 [&_button]:!text-emerald-800 dark:text-emerald-200 [&_button]:dark:!text-emerald-200 bg-emerald-400/20 dark:bg-emerald-400/40 [&:is(button)]:hover:bg-emerald-400/30 [&:is(button)]:hover:dark:bg-emerald-400/50',
                'teal'
                    => 'text-teal-800 [&_button]:!text-teal-800 dark:text-teal-200 [&_button]:dark:!text-teal-200 bg-teal-400/20 dark:bg-teal-400/40 [&:is(button)]:hover:bg-teal-400/30 [&:is(button)]:hover:dark:bg-teal-400/50',
                'cyan'
                    => 'text-cyan-800 [&_button]:!text-cyan-800 dark:text-cyan-200 [&_button]:dark:!text-cyan-200 bg-cyan-400/20 dark:bg-cyan-400/40 [&:is(button)]:hover:bg-cyan-400/30 [&:is(button)]:hover:dark:bg-cyan-400/50',
                'sky'
                    => 'text-sky-800 [&_button]:!text-sky-800 dark:text-sky-200 [&_button]:dark:!text-sky-200 bg-sky-400/20 dark:bg-sky-400/40 [&:is(button)]:hover:bg-sky-400/30 [&:is(button)]:hover:dark:bg-sky-400/50',
                'blue'
                    => 'text-blue-800 [&_button]:!text-blue-800 dark:text-blue-200 [&_button]:dark:!text-blue-200 bg-blue-400/20 dark:bg-blue-400/40 [&:is(button)]:hover:bg-blue-400/30 [&:is(button)]:hover:dark:bg-blue-400/50',
                'indigo'
                    => 'text-indigo-700 [&_button]:!text-indigo-700 dark:text-indigo-200 [&_button]:dark:!text-indigo-200 bg-indigo-400/20 dark:bg-indigo-400/40 [&:is(button)]:hover:bg-indigo-400/30 [&:is(button)]:hover:dark:bg-indigo-400/50',
                'violet'
                    => 'text-violet-700 [&_button]:!text-violet-700 dark:text-violet-200 [&_button]:dark:!text-violet-200 bg-violet-400/20 dark:bg-violet-400/40 [&:is(button)]:hover:bg-violet-400/30 [&:is(button)]:hover:dark:bg-violet-400/50',
                'purple'
                    => 'text-purple-700 [&_button]:!text-purple-700 dark:text-purple-200 [&_button]:dark:!text-purple-200 bg-purple-400/20 dark:bg-purple-400/40 [&:is(button)]:hover:bg-purple-400/30 [&:is(button)]:hover:dark:bg-purple-400/50',
                'fuchsia'
                    => 'text-fuchsia-700 [&_button]:!text-fuchsia-700 dark:text-fuchsia-200 [&_button]:dark:!text-fuchsia-200 bg-fuchsia-400/20 dark:bg-fuchsia-400/40 [&:is(button)]:hover:bg-fuchsia-400/30 [&:is(button)]:hover:dark:bg-fuchsia-400/50',
                'pink'
                    => 'text-pink-700 [&_button]:!text-pink-700 dark:text-pink-200 [&_button]:dark:!text-pink-200 bg-pink-400/20 dark:bg-pink-400/40 [&:is(button)]:hover:bg-pink-400/30 [&:is(button)]:hover:dark:bg-pink-400/50',
                'rose'
                    => 'text-rose-700 [&_button]:!text-rose-700 dark:text-rose-200 [&_button]:dark:!text-rose-200 bg-rose-400/20 dark:bg-rose-400/40 [&:is(button)]:hover:bg-rose-400/30 [&:is(button)]:hover:dark:bg-rose-400/50',
            },
        )
        ->add(
            // Variant...
            match ($variant) {
                'default' => 'rounded-md px-2',
                'pill' => 'rounded-full px-3',
            },
        )
        ->add(
            // Text size...
            match ($size) {
                'sm' => 'text-xs py-1',
                'base' => 'text-sm py-1',
                'lg' => 'text-sm py-1.5',
            },
        )
        ->add(
            // Icon spacing...
            match ($size) {
                'sm' => '[&_[data-badge-icon]]:size-3 [&_[data-badge-icon-trailing]]:size-3 [&_[data-badge-icon]]:mr-1 [&_[data-badge-icon-trailing]]:ml-1',
                'base' => '[&_[data-badge-icon]]:mr-1.5 [&_[data-badge-icon-trailing]]:ml-1.5',
                'lg' => '[&_[data-badge-icon]]:mr-2 [&_[data-badge-icon-trailing]]:ml-2',
            },
        )
        ->add(
            // Inset...
            $inset
                ? match ($size) {
                    'sm' => ZincUi::applyInset($inset, top: '-mt-1', right: '-mr-1', bottom: '-mb-1', left: '-ml-1'),
                    'base' => ZincUi::applyInset($inset, top: '-mt-1', right: '-mr-1', bottom: '-mb-1', left: '-ml-1'),
                    'lg' => ZincUi::applyInset($inset, top: '-mt-2', right: '-mr-2', bottom: '-mb-2', left: '-ml-2'),
                }
                : '',
        );
@endphp

<?php if ($as == 'badge'): ?>
    <div {{ $attributes->class($classes) }} data-badge>
        <?php if (is_string($iconLeading) && $iconLeading !== ''): ?>
            <x-icon name="{{ $icon }}" class="shrink-0 [:where(&)]:size-4" data-badge-icon />
        <?php else: ?>
            {{ $iconLeading }}
        <?php endif; ?>

        {{ $slot }}

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            <x-icon name="{{ $iconTrailing }}" class="shrink-0 [:where(&)]:size-4" data-badge-icon-trailing />
        <?php else: ?>
            {{ $iconTrailing }}
        <?php endif; ?>
    </div>
<?php elseif ($as == 'button'): ?>
    <button type="button" {{ $attributes->class($classes) }} data-badge>
        <?php if (is_string($iconLeading) && $iconLeading !== ''): ?>
            <x-icon name="{{ $icon }}" class="shrink-0 [:where(&)]:size-4" data-badge-icon />
        <?php else: ?>
            {{ $iconLeading }}
        <?php endif; ?>

        {{ $slot }}

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            <x-icon name="{{ $iconTrailing }}" class="shrink-0 [:where(&)]:size-4" data-badge-icon-trailing />
        <?php else: ?>
            {{ $iconTrailing }}
        <?php endif; ?>
    </button>
<?php endif; ?>
