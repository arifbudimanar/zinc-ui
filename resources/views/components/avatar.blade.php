@props([
    'src' => null,
    'name' => null,
    'size' => 'base',
])

@php
    $sizeClasses = [
        'base' => 'size-10 rounded-lg',
        'sm' => 'size-8 rounded-md',
        'xs' => 'size-6 rounded',
    ][$size];

    $classes = 'overflow-hidden shrink-0' . ' ' . $sizeClasses;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} data-avatar>
    @if (is_string($src) && $src !== '')
        <img src="{{ $src }}" alt="{{ $name ? $name : 'Avatar' }}">
    @else
        {{ $slot }}
    @endif
</div>
