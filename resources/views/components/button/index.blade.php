@props([
    'type' => 'button',
    'variant' => 'outline',
    'size' => 'base',
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'kbd' => null,
    'tooltip' => null,
    'tooltipPosition' => 'top',
    'tooltipOffset' => 6,
    'tooltipKbd' => null,
    'inset' => null,
])

@php
    $square = $slot->isEmpty();
    $iconLeading = $icon ??= $iconLeading;
    $type = $variant === 'primary' ? 'submit' : $type;
    $classes = ZincUi::classes()
        ->add('relative items-center font-medium justify-center gap-2 whitespace-nowrap shrink-0')
        ->add('disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none')
        ->add($inset ? 'flex' : 'inline-flex')
        ->add(
            // Background color...
            match ($variant) {
                'primary' => 'bg-zinc-800 hover:bg-zinc-900 dark:bg-white dark:hover:bg-zinc-100',
                'filled' => 'bg-zinc-800/5 hover:bg-zinc-800/10 dark:bg-white/10 dark:hover:bg-white/20',
                'outline' => 'bg-white hover:bg-zinc-50 dark:bg-zinc-700 dark:hover:bg-zinc-600/75',
                'danger' => 'bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-500',
                'ghost' => 'bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15',
                'subtle' => 'bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15',
            },
        )
        ->add(
            // Text color...
            match ($variant) {
                'primary' => 'text-white dark:text-zinc-800',
                'filled' => 'text-zinc-800 dark:text-white',
                'outline' => 'text-zinc-800 dark:text-white',
                'danger' => 'text-white',
                'ghost' => 'text-zinc-800 dark:text-white',
                'subtle' => 'text-zinc-400 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white',
            },
        )
        ->add(
            // Border color...
            match ($variant) {
                'primary' => '',
                'filled' => '',
                'outline' => 'border border-zinc-200 hover:border-zinc-200 border-b-zinc-300/80 dark:border-zinc-600 dark:hover:border-zinc-600',
                'danger' => '',
                'ghost' => '',
                'subtle' => '',
            },
        )
        ->add(
            // Shadow...
            match ($variant) {
                'primary' => 'shadow-[inset_0px_1px_theme(colors.zinc.900),inset_0px_2px_theme(colors.white/.15)] dark:shadow-none',
                'filled' => '',
                'outline' => [
                    'base' => 'shadow-sm',
                    'sm' => 'shadow-sm',
                    'xs' => 'shadow-none',
                ][$size],
                'danger' => 'shadow-[inset_0px_1px_theme(colors.red.500),inset_0px_2px_theme(colors.white/.15)] dark:shadow-none',
                'ghost' => '',
                'subtle' => '',
            },
        )
        ->add(
            // Group border...
            match ($variant) {
                'primary' => '',
                'filled'
                    => '[[data-button-group]_&]:border-r [:is([data-button-group]>&:last-child,_[data-button-group]_:last-child>&)]:border-r-0 [[data-button-group]_&]:border-zinc-200/80 [[data-button-group]_&]:dark:border-zinc-900/50',
                'outline' => '[[data-button-group]_&]:border-l-0 [:is([data-button-group]>&:first-child,_[data-button-group]_:first-child>&)]:border-l-[1px]',
                'danger'
                    => '[[data-button-group]_&]:border-r [:is([data-button-group]>&:last-child,_[data-button-group]_:last-child>&)]:border-r-0 [[data-button-group]_&]:border-red-600 [[data-button-group]_&]:dark:border-red-900/25',
                'ghost' => '',
                'subtle' => '',
            },
        )
        ->add(
            // Size...
            match ($size) {
                'base' => 'h-10 text-sm rounded-lg' . ' ' . ($square ? 'w-10' : 'px-4'),
                'sm' => 'h-8 text-sm rounded-md' . ' ' . ($square ? 'w-8' : 'px-3'),
                'xs' => 'h-6 text-xs rounded-md' . ' ' . ($square ? 'w-6' : 'px-2'),
            },
        )
        ->add(
            // Inset...
            $inset
                ? match ($size) {
                    'base' => $square
                        ? ZincUi::applyInset($inset, top: '-mt-2.5', right: '-mr-2.5', bottom: '-mb-2.5', left: '-ml-2.5')
                        : ZincUi::applyInset($inset, top: '-mt-2.5', right: '-mr-4', bottom: '-mb-3', left: '-ml-4'),
                    'sm' => $square
                        ? ZincUi::applyInset($inset, top: '-mt-1.5', right: '-mr-1.5', bottom: '-mb-1.5', left: '-ml-1.5')
                        : ZincUi::applyInset($inset, top: '-mt-1.5', right: '-mr-3', bottom: '-mb-1.5', left: '-ml-3'),
                    'xs' => $square
                        ? ZincUi::applyInset($inset, top: '-mt-1', right: '-mr-1', bottom: '-mb-1', left: '-ml-1')
                        : ZincUi::applyInset($inset, top: '-mt-1', right: '-mr-2', bottom: '-mb-1', left: '-ml-2'),
                }
                : '',
        );

    $attributes = $attributes->merge([
        'data-group-target' => !in_array($variant, ['subtle', 'ghost']),
    ]);

    $iconClasses = ZincUi::classes()->add(
        match ($size) {
            'base' => 'inline-flex items-center shrink-0 size-5',
            'sm' => 'inline-flex items-center shrink-0 size-5',
            'xs' => 'inline-flex items-center shrink-0 size-4',
        },
    );
@endphp

<x-with-tooltip :$tooltip :$tooltipPosition :$tooltipOffset :$tooltipKbd :$attributes>
    <x-button-or-link :$type :attributes="$attributes->class($classes)" data-button>
        <?php if (is_string($iconLeading) && $iconLeading !== ''): ?>
            <x-icon :name="$iconLeading" :class="$iconClasses" />
        <?php else: ?>
            {{ $iconLeading }}
        <?php endif; ?>

        {{ $slot }}

        <?php if ($kbd && $size != 'xs'): ?>
            <x-kbd class="hidden lg:block">{{ $kbd }}</x-kbd>
        <?php endif; ?>

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            <x-icon :name="$iconTrailing" :class="$iconClasses" />
        <?php else: ?>
            {{ $iconTrailing }}
        <?php endif; ?>
    </x-button-or-link>
</x-with-tooltip>
