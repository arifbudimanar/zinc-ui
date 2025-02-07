@props([
    'size' => 'base',
    'level' => null,
])

@php
    $classes = ZincUi::classes()
        ->add('font-medium text-zinc-800 dark:text-white')
        ->add(
            match ($size) {
                'base' => 'text-sm',
                'lg' => 'text-base',
                'xl' => 'text-2xl',
            },
        )
        ->add('[&:has(+[data-subheading])]:mb-2 [[data-subheading]+&]:mt-2');

    $level = $level ? (int) $level : null;
@endphp

<?php if ($level == 1): ?>
    <h1 {{ $attributes->class($classes) }} data-heading>
        {{ $slot }}
    </h1>
<?php elseif ($level === 2): ?>
    <h2 {{ $attributes->class($classes) }} data-heading>
        {{ $slot }}
    </h2>
<?php elseif ($level === 3): ?>
    <h3 {{ $attributes->class($classes) }} data-heading>
        {{ $slot }}
    </h3>
<?php else: ?>
    <div {{ $attributes->class($classes) }} data-heading>
        {{ $slot }}
    </div>
<?php endif; ?>
