@props([
    'as' => 'badge',
    'label' => null,
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'color' => 'default',
    'variant' => 'default',
])

@php
    $iconLeading = $icon ??= $iconLeading;
    $colorClass = [
        'default' => 'text-zinc-800/70 dark:text-zinc-300 bg-zinc-800/5 dark:bg-white/10',
        'zinc' => 'text-zinc-700 dark:text-zinc-200 bg-zinc-400/15 dark:bg-zinc-400/40',
        'red' => 'text-red-700 dark:text-red-200 bg-red-400/20 dark:bg-red-400/40',
        'orange' => 'text-orange-700 dark:text-orange-200 bg-orange-400/20 dark:bg-orange-400/40',
        'amber' => 'text-amber-700 dark:text-amber-200 bg-amber-400/25 dark:bg-amber-400/40',
        'yellow' => 'text-yellow-800 dark:text-yellow-200 bg-yellow-400/25 dark:bg-yellow-400/40',
        'lime' => 'text-lime-800 dark:text-lime-200 bg-lime-400/25 dark:bg-lime-400/40',
        'green' => 'text-green-800 dark:text-green-200 bg-green-400/20 dark:bg-green-400/40',
        'emerald' => 'text-emerald-800 dark:text-emerald-200 bg-emerald-400/20 dark:bg-emerald-400/40',
        'teal' => 'text-teal-800 dark:text-teal-200 bg-teal-400/20 dark:bg-teal-400/40',
        'cyan' => 'text-cyan-800 dark:text-cyan-200 bg-cyan-400/20 dark:bg-cyan-400/40',
        'sky' => 'text-sky-800 dark:text-sky-200 bg-sky-400/20 dark:bg-sky-400/40',
        'blue' => 'text-blue-800 dark:text-blue-200 bg-blue-400/20 dark:bg-blue-400/40',
        'indigo' => 'text-indigo-700 dark:text-indigo-200 bg-indigo-400/20 dark:bg-indigo-400/40',
        'violet' => 'text-violet-700 dark:text-violet-200 bg-violet-400/20 dark:bg-violet-400/40',
        'purple' => 'text-purple-700 dark:text-purple-200 bg-purple-400/20 dark:bg-purple-400/40',
        'fuchsia' => 'text-fuchsia-700 dark:text-fuchsia-200 bg-fuchsia-400/20 dark:bg-fuchsia-400/40',
        'pink' => 'text-pink-700 dark:text-pink-200 bg-pink-400/20 dark:bg-pink-400/40',
        'rose' => 'text-rose-700 dark:text-rose-200 bg-rose-400/20 dark:bg-rose-400/40',
    ][$color];
    $variantClass = [
        'default' => 'rounded px-1 py-0.5',
        'pill' => 'rounded-full px-2.5',
    ][$variant];
@endphp

@if ($as == 'badge')
    <span
        {{ $attributes->merge([
            'class' =>
                'inline-flex items-center font-medium gap-1.5 whitespace-nowrap text-xs select-none' .
                ' ' .
                $variantClass .
                ' ' .
                $colorClass,
        ]) }}>
        @if (is_string($iconLeading))
            <x-icon :name="$iconLeading" class="inline-flex items-center shrink-0 size-4" />
        @else
            {{ $iconLeading }}
        @endif

        {{ $label ?? $slot }}

        @if (is_string($iconTrailing))
            <x-icon :name="$iconTrailing" class="inline-flex items-center shrink-0 size-4" />
        @else
            {{ $iconTrailing }}
        @endif
    </span>
@endif

@if ($as == 'button')
    <button
        {{ $attributes->merge([
            'type' => 'button',
            'class' =>
                'inline-flex items-center font-medium gap-1.5 whitespace-nowrap text-xs py-1 select-none' .
                ' ' .
                $variantClass .
                ' ' .
                $colorClass,
        ]) }}>
        @if (is_string($iconLeading))
            <x-icon :name="$iconLeading" class="inline-flex items-center shrink-0 size-4" />
        @else
            {{ $iconLeading }}
        @endif

        {{ $label ?? $slot }}

        @if (is_string($iconTrailing))
            <x-icon :name="$iconTrailing" class="inline-flex items-center shrink-0 size-4" />
        @else
            {{ $iconTrailing }}
        @endif
    </button>
@endif
