@props([
    'orientation' => 'horizontal',
    'variant' => 'default',
    'text' => null,
])

@php
    $orientation = $attributes->has('vertical') ? 'vertical' : 'horizontal';

    $variantClass = [
        'default' => 'bg-zinc-200 dark:bg-zinc-600',
        'subtle' => 'bg-zinc-800/5 dark:bg-white/10',
    ][$variant];

    $orientationClass = [
        'horizontal' => 'h-px w-full',
        'vertical' => 'self-stretch self-center w-px',
    ][$orientation];
@endphp

@if ($text !== null)
    <div data-orientation="{{ $orientation }}" class="flex items-center w-full" role="none" data-separator>
        <div {{ $attributes->merge(['class' => 'grow' . ' ' . $variantClass . ' ' . $orientationClass]) }}></div>

        <span class="mx-6 text-sm font-medium select-none shrink text-zinc-500 dark:text-zinc-300 whitespace-nowrap">
            {{ $text }}
        </span>

        <div {{ $attributes->merge(['class' => 'grow' . ' ' . $variantClass . ' ' . $orientationClass]) }}></div>
    </div>
@else
    <div data-orientation="{{ $orientation }}" role="none"
        {{ $attributes->merge(['class' => 'shrink-0' . ' ' . $variantClass . ' ' . $orientationClass]) }}
        data-separator></div>
@endif
