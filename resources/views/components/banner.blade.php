@props([
    'variant' => 'info',
])

@php

    $classes = [
        'success' => 'text-lime-600 dark:text-lime-400',
        'error' => 'text-rose-500 dark:text-rose-400',
        'warning' => 'text-amber-500 dark:text-amber-400',
        'info' => 'text-zinc-500 dark:text-zinc-300',
    ][$variant];

    $icon = [
        'success' => 's-check-circle',
        'error' => 's-exclamation-circle',
        'warning' => 's-exclamation-triangle',
        'info' => 's-information-circle',
    ][$variant];

@endphp

<div
    {{ $attributes->merge(['class' => 'flex items-start px-5 py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800' . ' ' . $classes]) }}>
    <div class="flex items-center mr-3 size-6">
        <x-icon name="{{ $icon }}" class="size-5" />
    </div>
    <div>
        {{ $slot }}
    </div>
</div>
