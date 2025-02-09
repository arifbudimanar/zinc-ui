@props([
    'container' => false,
])

@php
    $classes = ZincUi::classes()
        ->add('[grid-area:footer] p-6 lg:p-8 w-full')
        ->add($container ? 'mx-auto [:where(&)]:max-w-7xl' : '');
@endphp

<footer {{ $attributes->class($classes) }} data-main>
    {{ $slot }}
</footer>
