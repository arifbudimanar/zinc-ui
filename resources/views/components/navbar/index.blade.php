@props([
    'scrollable' => false,
])

@php
    $classes = ZincUi::classes()
        ->add('flex items-center gap-1 py-3')
        ->add($scrollable ? 'overflow-x-auto overflow-y-hidden' : '');
@endphp

<nav {{ $attributes->class($classes) }} data-navbar>
    {{ $slot }}
</nav>
