@props([
    'variant' => 'default',
    'size' => 'base',
])

@aware(['variant' => $variant])

@php
    $classes = ZincUi::classes()->add(
        match ($variant) {
            'default' => 'flex gap-4 min-h-full border-b border-zinc-800/10 dark:border-white/20 overflow-scroll scrollbar-none pb-[1px]',
            'segmented' => [
                'base' => 'inline-flex rounded-lg bg-zinc-800/5 dark:bg-white/10 h-10 p-1 overflow-scroll scrollbar-none w-full',
                'sm' => '-my-px inline-flex h-[calc(2rem+2px)] rounded-lg bg-zinc-800/5 px-[3px] py-[3px] dark:bg-white/10 overflow-scroll scrollbar-none w-full',
            ][$size],
        },
    );
@endphp

<div role="tablist" {{ $attributes->class($classes) }}
    x-on:keydown.right.prevent="$focus.next()"
    x-on:keydown.left.prevent="$focus.previous()" data-tabs>
    {{ $slot }}
</div>
