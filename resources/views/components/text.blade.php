@props([
    'size' => 'base',
])

@php
    $classes = ZincUi::classes()
        ->add(
            match ($size) {
                'sm' => 'text-xs',
                'base' => 'text-sm',
                'lg' => 'text-base',
                'xl' => 'text-lg',
            },
        )
        ->add('text-zinc-500 dark:text-white/70');
@endphp

<div {{ $attributes->class($classes) }} data-text>
    {{ $slot }}
</div>
