@props([
    'variant' => 'default',
])

@php
    $classes = ZincUi::classes()
        ->add(
            match ($variant) {
                'default' => 'text-sm',
                'strong' => 'text-medium',
            },
        )
        ->add('py-3 px-3 first:pl-0 last:pr-0 text-zinc-500 dark:text-zinc-300');
@endphp

<td {{ $attributes->class($classes) }} data-cell>
    {{ $slot }}
</td>
