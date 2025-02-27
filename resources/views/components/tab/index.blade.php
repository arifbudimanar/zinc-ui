@props([
    'variant' => 'default',
    'name' => null,
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'size' => 'base',
])

@aware([
    'variant' => $variant,
    'size' => $size,
])

@php
    $iconLeading = $icon ??= $iconLeading;
    $classes = ZincUi::classes()->add(
        match ($variant) {
            'default'
                => 'flex whitespace-nowrap gap-2 items-center h-10 px-2 -mb-px border-b-[2px] border-transparent text-sm font-medium text-zinc-400 dark:text-white/50 hover:text-zinc-800 dark:hover:text-white disabled:opacity-50 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none',
            'segmented' => [
                'base' =>
                    'flex whitespace-nowrap flex-1 justify-center items-center gap-2 rounded-md text-sm font-medium text-zinc-600 hover:text-zinc-800 dark:hover:text-white dark:text-white/70 disabled:opacity-50 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none px-4',
                'sm' =>
                    'flex whitespace-nowrap flex-1 justify-center items-center gap-2 rounded-md text-sm font-medium text-zinc-600 hover:text-zinc-800 dark:hover:text-white dark:text-white/70 disabled:opacity-50 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none px-3',
            ][$size],
        },
    );
@endphp

<?php if ($variant === 'default'): ?>
<button type="button" role="tab" {{ $attributes->class($classes) }}
    x-on:click="selectedTab = '{{ $name }}'"
    x-on:focusin="selectedTab = '{{ $name }}'"
    x-bind:aria-selected="selectedTab === '{{ $name }}'"
    x-bind:tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
    x-bind:class="selectedTab === '{{ $name }}' ?
        '!text-zinc-800 dark:!text-white hover:!text-zinc-800 dark:hover:!text-white !border-zinc-800 dark:!border-white' :
        'text-zinc-400 dark:text-white/50 hover:text-zinc-800 dark:hover:text-white border-transparent'"
    data-tab>
    <?php if (is_string($iconLeading)): ?>
    <x-icon :name="$iconLeading" class="size-5 shrink-0" />
    <?php else: ?>
    {{ $iconLeading }}
    <?php endif; ?>

    {{ $slot }}

    <?php if (is_string($iconTrailing)): ?>
    <x-icon :name="$iconTrailing" class="size-5 shrink-0" />
    <?php else: ?>
    {{ $iconTrailing }}
    <?php endif; ?>
</button>
<?php elseif ($variant === 'segmented'): ?>
<button type="button" role="tab" {{ $attributes->class($classes) }}
    x-on:click="selectedTab = '{{ $name }}'"
    x-on:focusin="selectedTab = '{{ $name }}'"
    x-bind:aria-selected="selectedTab === '{{ $name }}'"
    x-bind:tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
    x-bind:class="selectedTab === '{{ $name }}' ?
        '!text-zinc-800 dark:!text-white hover:!text-zinc-800 dark:hover:!text-white !bg-white dark:!bg-white/20 shadow-xs' :
        'text-zinc-600 dark:text-white/70 hover:text-zinc-800 dark:hover:text-white'"
    data-tab>
    <?php if (is_string($iconLeading)): ?>
    <x-icon :name="$iconLeading" class="{{ $size == 'base' ? 'size-5' : 'size-4' }} shrink-0" />
    <?php else: ?>
    {{ $iconLeading }}
    <?php endif; ?>

    {{ $slot }}

    <?php if (is_string($iconTrailing)): ?>
    <x-icon :name="$iconTrailing" class="{{ $size == 'base' ? 'size-5' : 'size-4' }} shrink-0" />
    <?php else: ?>
    {{ $iconTrailing }}
    <?php endif; ?>
</button>
<?php endif; ?>
