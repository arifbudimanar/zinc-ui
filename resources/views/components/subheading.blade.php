@props([
    'size' => 'base',
    'level' => null,
])

@php
    $sizeClasses = [
        'base' => 'text-sm',
        'lg' => 'text-base',
        'xl' => 'text-2xl',
    ][$size];

    $classes = 'text-zinc-500 dark:text-white/70' . ' ' . $sizeClasses;

    $level = $level ? (int) $level : null;
@endphp

@if ($level === 1)
    <h1 {{ $attributes->merge(['class' => $classes]) }} data-subheading>
        {{ $slot }}
    </h1>
@elseif ($level === 2)
    <h2 {{ $attributes->merge(['class' => $classes]) }} data-subheading>
        {{ $slot }}
    </h2>
@elseif ($level === 3)
    <h3 {{ $attributes->merge(['class' => $classes]) }} data-subheading>
        {{ $slot }}
    </h3>
@else
    <div {{ $attributes->merge(['class' => $classes]) }} data-subheading>
        {{ $slot }}
    </div>
@endif
