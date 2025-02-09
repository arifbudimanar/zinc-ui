@props([
    'avatar' => null,
    'name' => null,
    'size' => 'sm',
    'chevron' => 'default',
])

@php
    $classes = 'group flex items-center rounded-lg p-1 hover:bg-zinc-800/5 dark:hover:bg-white/10 text-zinc-400 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white';
@endphp

<button type="button" {{ $attributes->class($classes) }} data-profile>
    <?php if (is_string($avatar) && $avatar !== ''): ?>
        <x-avatar :$size class="bg-zinc-800/5 dark:bg-white/10">
            <img src="{!! $avatar !!}" alt="{{ $name }}" class="dark:invert">
        </x-avatar>
    <?php else: ?>
        <x-avatar :$size class="bg-zinc-800/5 dark:bg-white/10">
            {{ $avatar }}
        </x-avatar>
    <?php endif; ?>

    <?php if ($name): ?>
        <span class="ml-2 text-sm font-medium truncate lg:ml-3 text-zinc-500 dark:text-white/80 group-hover:text-zinc-800 group-hover:dark:text-white">
            {{ $name }}
        </span>
    <?php endif; ?>

    <div class="flex items-center justify-center ml-auto shrink-0 size-8">
        <?php if ($chevron === 'default'): ?>
            <x-icon name="o-chevron-down" class="shrink-0 size-5" x-show="!isDropdownOpen" />
            <x-icon name="o-chevron-up" class="shrink-0 size-5" x-show="isDropdownOpen" x-cloak />
        <?php endif; ?>

        <?php if ($chevron === 'reverse'): ?>
            <x-icon name="o-chevron-up" class="shrink-0 size-5" x-show="!isDropdownOpen" />
            <x-icon name="o-chevron-down" class="shrink-0 size-5" x-show="isDropdownOpen" x-cloak />
        <?php endif; ?>
    </div>
</button>
