@props([
    'container' => false,
])

@php
    $classes = ZincUi::classes()
        ->add('[grid-area:main] p-6 lg:p-8 w-full')
        ->add($container ? 'mx-auto max-w-7xl' : '');
@endphp

<main {{ $attributes->class($classes) }} data-main>
    {{ $slot }}
</main>
