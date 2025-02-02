@props([
    'src' => null,
    'name' => null,
    'size' => 'base',
])

@php
    $classes = ZincUi::classes()
        ->add('overflow-hidden shrink-0')
        ->add(
            match ($size) {
                'base' => 'size-10 rounded-lg',
                'sm' => 'size-8 rounded-md',
                'xs' => 'size-6 rounded',
            },
        );
@endphp

<div {{ $attributes->class($classes) }} data-avatar>
    <?php if (is_string($src) && $src !== ''): ?>
        <img src="{{ $src }}" alt="{{ $name ? $name : 'Avatar' }}">
    <?php else: ?>
        {{ $slot }}
    <?php endif; ?>
</div>
