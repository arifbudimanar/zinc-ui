@props([
    'size' => 'default',
    'label' => null,
])

@php
    $sizeClasses = [
        'default' => 'text-sm',
        'lg' => 'text-base',
        'xl' => 'text-2xl',
    ][$size];

    $classes = 'text-zinc-500 dark:text-white/70' . ' ' . $sizeClasses;
@endphp

<p {{ $attributes->merge(['class' => $classes]) }} data-subheading>
    {{ $label ?? $slot }}
</p>
