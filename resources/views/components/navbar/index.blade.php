@props([
    'scrollable' => false,
])
@php
    $scrollableClasses = $scrollable ? 'overflow-x-auto overflow-y-hidden' : '';

    $classes = 'flex items-center gap-1 py-3' . ' ' . $scrollableClasses;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
