@props([
    'type' => 'button',
    'variant' => 'outline',
    'size' => 'base',
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'label' => null,
    'kbd' => null,
    'tooltip' => null,
    'tooltipPosition' => 'top',
    'tooltipOffset' => 6,
    'tooltipKbd' => null,
    'inset' => null,
])

@php
    $square = !empty($icon || $iconLeading || $iconTrailing) && empty($label) && $slot->isEmpty();
    $iconLeading = $icon ??= $iconLeading;

    $type = $variant === 'primary' ? 'submit' : $type;

    $disabled = $attributes->has('disabled');

    $backgroundClass = [
        'primary' => 'bg-zinc-800 hover:bg-zinc-900 dark:bg-white dark:hover:bg-zinc-100',
        'filled' => 'bg-zinc-800/5 hover:bg-zinc-800/10 dark:bg-white/10 dark:hover:bg-white/20',
        'outline' => 'bg-white hover:bg-zinc-50 dark:bg-zinc-700 dark:hover:bg-zinc-600/75',
        'danger' => 'bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-500',
        'ghost' => 'bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15',
        'subtle' => 'bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15',
    ][$variant];

    $textClass = [
        'primary' => 'text-white dark:text-zinc-800',
        'filled' => 'text-zinc-800 dark:text-white',
        'outline' => 'text-zinc-800 dark:text-white',
        'danger' => 'text-white',
        'ghost' => 'text-zinc-800 dark:text-white',
        'subtle' => 'text-zinc-400 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white',
    ][$variant];

    $outlineClass = [
        'primary' => '',
        'filled' => '',
        'outline' =>
            'border border-zinc-200 hover:border-zinc-200 border-b-zinc-300/80 dark:border-zinc-600 dark:hover:border-zinc-600',
        'danger' => '',
        'ghost' => '',
        'subtle' => '',
    ][$variant];

    $shadowClass = [
        'primary' =>
            'shadow-[inset_0px_1px_theme(colors.zinc.900),inset_0px_2px_theme(colors.white/.15)] dark:shadow-none',
        'filled' => '',
        'outline' => [
            'base' => 'shadow-sm',
            'sm' => 'shadow-sm',
            'xs' => 'shadow-none',
        ][$size],
        'danger' =>
            'shadow-[inset_0px_1px_theme(colors.red.500),inset_0px_2px_theme(colors.white/.15)] dark:shadow-none',
        'ghost' => '',
        'subtle' => '',
    ][$variant];

    $groupClass = [
        'primary' => '',
        'outline' =>
            '[[data-button-group]_&]:border-l-0 [:is([data-button-group]>&:first-child,_[data-button-group]_:first-child>&)]:border-l-[1px]',
        'filled' =>
            '[[data-button-group]_&]:border-r [:is([data-button-group]>&:last-child,_[data-button-group]_:last-child>&)]:border-r-0 [[data-button-group]_&]:border-zinc-200/80 [[data-button-group]_&]:dark:border-zinc-900/50',
        'danger' =>
            '[[data-button-group]_&]:border-r [:is([data-button-group]>&:last-child,_[data-button-group]_:last-child>&)]:border-r-0 [[data-button-group]_&]:border-red-600 [[data-button-group]_&]:dark:border-red-900/25',
        'ghost' => '',
        'subtle' => '',
    ][$variant];

    $sizeClass = [
        'base' => 'h-10 text-sm rounded-lg',
        'sm' => 'h-8 text-sm rounded-md',
        'xs' => 'h-6 text-xs rounded-md',
    ][$size];

    $widthClass = [
        'base' => $square ? 'w-10 shrink-0' : 'px-4',
        'sm' => $square ? 'w-8 shrink-0' : 'px-3',
        'xs' => $square ? 'w-6 shrink-0' : 'px-2',
    ][$size];

    $iconSizeClass = [
        'base' => 'size-5',
        'sm' => 'size-5',
        'xs' => 'size-4',
    ][$size];

    $insetClass = '';
    if ($inset) {
        $insets = $inset === true ? ['top', 'right', 'bottom', 'left'] : explode(' ', $inset);

        $insetValues = match ($size) {
            'base' => $square
                ? ['top' => '-mt-2.5', 'right' => '-mr-2.5', 'bottom' => '-mb-2.5', 'left' => '-ml-2.5']
                : ['top' => '-mt-2.5', 'right' => '-mr-4', 'bottom' => '-mb-3', 'left' => '-ml-4'],
            'sm' => $square
                ? ['top' => '-mt-1.5', 'right' => '-mr-1.5', 'bottom' => '-mb-1.5', 'left' => '-ml-1.5']
                : ['top' => '-mt-1.5', 'right' => '-mr-3', 'bottom' => '-mb-1.5', 'left' => '-ml-3'],
            'xs' => $square
                ? ['top' => '-mt-1', 'right' => '-mr-1', 'bottom' => '-mb-1', 'left' => '-ml-1']
                : ['top' => '-mt-1', 'right' => '-mr-2', 'bottom' => '-mb-1', 'left' => '-ml-2'],
        };

        $insetClass = collect($insets)
            ->map(fn($side) => trim($side))
            ->map(fn($side) => $insetValues[$side] ?? '')
            ->filter()
            ->join(' ');
    }
    $flexClass = $inset ? 'flex' : 'inline-flex';

    $class =
        'relative items-center justify-center gap-2 font-medium whitespace-nowrap' .
        ' ' .
        $flexClass .
        ' ' .
        $backgroundClass .
        ' ' .
        $textClass .
        ' ' .
        $outlineClass .
        ' ' .
        $sizeClass .
        ' ' .
        $widthClass .
        ' ' .
        $shadowClass .
        ' ' .
        $groupClass .
        ' ' .
        $insetClass .
        ' ' .
        'disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none';
@endphp

<x-with-tooltip :$tooltip :$tooltipPosition :$tooltipOffset :$tooltipKbd {{ $attributes->whereStartsWith('class') }}>
    <x-button-or-link
        {{ $attributes->merge([
            'type' => $type,
            'disabled' => $disabled,
            'class' => $class,
            'data-group-target' => !in_array($variant, ['subtle', 'ghost']),
        ]) }}
        data-button>
        @if (is_string($iconLeading) && $iconLeading !== '')
            <x-icon :name="$iconLeading" class="inline-flex items-center shrink-0 {{ $iconSizeClass }}" />
        @else
            {{ $iconLeading }}
        @endif

        {{ $label ?? $slot }}

        @if ($kbd && $size !== 'xs')
            <x-kbd class="hidden lg:block">{{ $kbd }}</x-kbd>
        @endif

        @if (is_string($iconTrailing) && $iconTrailing !== '')
            <x-icon :name="$iconTrailing" class="inline-flex items-center shrink-0 {{ $iconSizeClass }}" />
        @else
            {{ $iconTrailing }}
        @endif
    </x-button-or-link>
</x-with-tooltip>
