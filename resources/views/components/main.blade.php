@props([
    'container' => false,
])

@php
    $containerClass = $container ? 'mx-auto' : '';

    $classes = '[grid-area:main] p-6 lg:p-8 w-full' . ' ' . $containerClass;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} data-main>
    {{ $slot }}
</div>
