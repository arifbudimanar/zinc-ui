@props([
    'size' => 'base',
    'level' => null,
])

@php
    $classes = ZincUi::classes()
        ->add('text-zinc-500 dark:text-white/70')
        ->add(
            match ($size) {
                'base' => 'text-sm',
                'lg' => 'text-base',
                'xl' => 'text-2xl',
            },
        );

    $level = $level ? (int) $level : null;
@endphp

<?php if ($level == 1): ?>
    <h1 {{ $attributes->class($classes) }} data-subheading>
        {{ $slot }}
    </h1>
<?php elseif ($level === 2): ?>
    <h2 {{ $attributes->class($classes) }} data-subheading>
        {{ $slot }}
    </h2>
<?php elseif ($level === 3): ?>
    <h3 {{ $attributes->class($classes) }} data-subheading>
        {{ $slot }}
    </h3>
<?php else: ?>
    <div {{ $attributes->class($classes) }} data-subheading>
        {{ $slot }}
    </div>
<?php endif; ?>
