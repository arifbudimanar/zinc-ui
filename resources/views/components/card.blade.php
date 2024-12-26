@props(['variant' => 'default'])

@php
    $variantClasses = [
        'default' =>
            'w-full p-6 border rounded-xl bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10',
        'subtle' => 'w-full',
        'dashed' =>
            'p-6 rounded-xl bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 bg-zinc-600/5 border-dashed border-zinc-600/10 border',
    ][$variant];
@endphp

<div {{ $attributes->merge(['class' => 'text-sm text-zinc-500 dark:text-white/70' . ' ' . $variantClasses]) }}
    data-card>
    {{ $slot }}
</div>
