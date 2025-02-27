@props(['label', 'variant' => 'default', 'as' => 'link'])

@php
    $classes = ZincUi::classes()
        ->add('[:where(&)]:inline text-inherit font-medium')
        ->add(
            match ($variant) {
                'default' => 'text-zinc-800 dark:text-white underline underline-offset-[6px] decoration-zinc-800/20 dark:decoration-white/20 hover:decoration-current dark:hover:decoration-current',
                'subtle' => 'text-zinc-500 dark:text-white/70 hover:text-zinc-800 dark:hover:text-white',
            },
        );
@endphp

<?php if ($as == 'link'): ?>
    <a {{ $attributes->class($classes) }}>
        {{ $label ?? $slot }}
    </a>
<?php elseif ($as == 'button'): ?>
    <button {{ $attributes->class($classes) }}>
        {{ $label ?? $slot }}
    </button>
<?php endif; ?>
