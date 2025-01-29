@props([
    'variant' => 'default',
    'size' => 'base',
])

@aware(['variant' => $variant])

@if ($variant == 'default')
    <div {{ $attributes->merge(['class' => 'flex gap-4 min-h-full border-b border-zinc-800/10 dark:border-white/20 overflow-scroll scrollbar-none pb-[1px]']) }}
        x-on:keydown.right.prevent="$focus.next()" x-on:keydown.left.prevent="$focus.previous()" role="tablist" data-tabs>
        {{ $slot }}
    </div>
@endif

@if ($variant == 'segmented')
    @if ($size == 'base')
        <div {{ $attributes->merge(['class' => 'inline-flex rounded-lg bg-zinc-800/5 dark:bg-white/10 h-10 p-1 overflow-scroll scrollbar-none w-auto sm:w-min']) }}
            x-on:keydown.right.prevent="$focus.next()" x-on:keydown.left.prevent="$focus.previous()" role="tablist" data-tabs>
            {{ $slot }}
        </div>
    @endif
    @if ($size == 'sm')
        <div {{ $attributes->merge(['class' => '-my-px inline-flex h-[calc(2rem+2px)] rounded-lg bg-zinc-800/5 px-[3px] py-[3px] dark:bg-white/10']) }}
            x-on:keydown.right.prevent="$focus.next()" x-on:keydown.left.prevent="$focus.previous()" role="tablist" data-tabs>
            {{ $slot }}
        </div>
    @endif
@endif
