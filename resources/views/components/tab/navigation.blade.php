@props(['variant' => 'default'])

@aware(['variant' => $variant])

@if ($variant === 'default')
    <div class="py-1 overflow-x-auto scrollbar-none">
        <div x-on:keydown.right.prevent="$focus.next()" x-on:keydown.left.prevent="$focus.previous()" role="tablist"
            {{ $attributes->merge([
                'class' => 'flex h-full gap-4 px-4 flex-nowrap border-b min-w-max border-zinc-800/10 dark:border-white/20',
            ]) }}>
            {{ $slot }}
        </div>
    </div>
@endif

@if ($variant === 'segmented')
    <div class="flex justify-start overflow-x-auto rounded-lg scrollbar-none md:justify-center">
        <div x-on:keydown.right.prevent="$focus.next()" x-on:keydown.left.prevent="$focus.previous()" role="tablist"
            {{ $attributes->merge([
                'class' => 'flex p-1 rounded-lg bg-zinc-800/5 dark:bg-white/10',
            ]) }}>
            {{ $slot }}
        </div>
    </div>
@endif
