@props([
    'variant' => 'outline',
    'label' => null,
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
    $textClass = [
        'filled' => 'text-zinc-800 dark:text-zinc-100 hover:text-zinc-800 hover:dark:text-zinc-100',
        'outline' => 'text-zinc-800 dark:text-zinc-100 hover:text-zinc-800 hover:dark:text-zinc-100',
    ][$variant];

    $backgroundClass = [
        'filled' => 'bg-zinc-800/5 dark:bg-white/10',
        'outline' => 'bg-white dark:bg-white/10',
    ][$variant];

    $borederClass = [
        'filled' => 'border-none',
        'outline' => 'border border-zinc-200 dark:border-white/10',
    ][$variant];

    $shadowClass = [
        'filled' => 'shadow-sm',
        'outline' => 'shadow-sm',
    ][$variant];

    $activeClasses = $active
        ? $textClass . ' ' . $backgroundClass . ' ' . $borederClass . ' ' . $shadowClass
        : 'text-zinc-500 dark:text-white/80 hover:text-zinc-800 hover:dark:text-white hover:bg-zinc-100 hover:dark:bg-white/10 border border-transparent';
@endphp

<x-button-or-link
    {{ $attributes->merge([
        'class' =>
            'relative flex items-center w-full h-10 lg:h-8 gap-3 px-2.5 lg:px-3 py-0 my-px rounded-lg text-left' .
            ' ' .
            $activeClasses,
    ]) }}>
    @if (is_string($iconLeading))
        <x-icon :name="$iconLeading" class="inline-flex items-center shrink-0 size-5" />
    @else
        {{ $iconLeading }}
    @endif

    <div class="flex-1 text-sm font-medium leading-none whitespace-nowrap">
        {{ $label ?? $slot }}
    </div>

    @if (is_string($iconTrailing))
        <x-icon :name="$iconTrailing" class="inline-flex items-center shrink-0 size-5" />
    @else
        {{ $iconTrailing }}
    @endif

    @isset($badge)
        <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="!px-1 !py-0.5">
            {{ $badge }}
        </x-badge>
    @endisset
</x-button-or-link>
