@props([
    'container' => false,
    'sticky' => false,
])

@php
    $classes = ZincUi::classes()
        ->add('[grid-area:header] flex items-center min-h-14 w-full')
        ->add($container ? '' : 'px-6 lg:px-8')
        ->add($sticky ? 'sticky top-0 z-10' : '');
@endphp

<?php if ($container): ?>
    <header {{ $attributes->class($classes) }} data-header>
        <div class="mx-auto flex h-full w-full max-w-7xl items-center px-6 lg:px-8">
            {{ $slot }}
        </div>
    </header>
<?php else: ?>
    <header {{ $attributes->class($classes) }} data-header>
        {{ $slot }}
    </header>
<?php endif; ?>
