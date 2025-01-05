@props([
    'label' => null,
    'active' => false,
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
])

@php
    $iconLeading = $icon ??= $iconLeading;
    $activeClasses = $active
        ? 'relative flex items-center gap-3 px-3 h-8 rounded-lg text-zinc-800 dark:text-white hover:text-zinc-800 hover:dark:text-white hover:bg-zinc-100 hover:dark:bg-white/10 after:absolute after:-bottom-3 after:inset-x-0 after:h-[2px] after:bg-zinc-800 after:dark:bg-white'
        : 'relative flex items-center gap-3 px-3 h-8 rounded-lg text-zinc-500 dark:text-zinc-200 hover:text-zinc-800 hover:dark:text-white hover:bg-zinc-100 hover:dark:bg-white/10';
@endphp

<x-button-or-link {{ $attributes->merge([
    'class' => $activeClasses,
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
        <x-badge color="{{ $badgeColor }}" class="-ml-1">
            {{ $badge }}
        </x-badge>
    @endisset
</x-button-or-link>
