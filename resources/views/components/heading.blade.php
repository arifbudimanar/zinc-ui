@props([
    'size' => 'default',
    'level' => null,
    'label' => null,
])

@php
    $sizeClasses = [
        'default' => 'text-sm',
        'lg' => 'text-base',
        'xl' => 'text-2xl',
    ][$size];

    $classes =
        'font-medium text-zinc-800 dark:text-white [&:has(+[data-subheading])]:mb-2 [[data-subheading]+&]:mt-2' .
        ' ' .
        $sizeClasses;
@endphp

@if ($level === 1)
    <h1 {{ $attributes->merge(['class' => $classes]) }} data-heading>
        {{ $label ?? $slot }}
    </h1>
@elseif ($level === 2)
    <h2 {{ $attributes->merge(['class' => $classes]) }} data-heading>
        {{ $label ?? $slot }}
    </h2>
@elseif ($level === 3)
    <h3 {{ $attributes->merge(['class' => $classes]) }} data-heading>
        {{ $label ?? $slot }}
    </h3>
@else
    <div {{ $attributes->merge(['class' => $classes]) }} data-heading>
        {{ $label ?? $slot }}
    </div>
@endif
