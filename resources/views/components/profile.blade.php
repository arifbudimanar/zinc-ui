@props([
    'avatar' => null,
    'name' => null,
    'size' => 'sm',
    'chevron' => 'default',
])

<button type="button"
    {{ $attributes->merge(['class' => 'group flex items-center rounded-lg p-1 hover:bg-zinc-800/5 dark:hover:bg-white/10 text-zinc-400 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white']) }}
    data-profile>
    @if (is_string($avatar) && $avatar !== '')
        <x-avatar :$size class="bg-zinc-800/5 dark:bg-white/10">
            <x-slot:src>
                <img src="{!! $avatar !!}" alt="{{ $name }}" class="dark:invert">
            </x-slot:src>
        </x-avatar>
    @else
        <x-avatar :$size class="bg-zinc-800/5 dark:bg-white/10">
            {{ $avatar }}
        </x-avatar>
    @endif

    @if ($name)
        <span
            class="ml-2 text-sm font-medium truncate lg:ml-3 text-zinc-500 dark:text-white/80 group-hover:text-zinc-800 group-hover:dark:text-white">
            {{ $name }}
        </span>
    @endif

    <div class="flex items-center justify-center ml-auto shrink-0 size-8">
        @if ($chevron === 'default')
            <x-icon name="o-chevron-down" class="shrink-0 size-5" x-show="!isDropdownOpen" />
            <x-icon name="o-chevron-up" class="shrink-0 size-5" x-show="isDropdownOpen" x-cloak />
        @endif

        @if ($chevron === 'reverse')
            <x-icon name="o-chevron-up" class="shrink-0 size-5" x-show="!isDropdownOpen" />
            <x-icon name="o-chevron-down" class="shrink-0 size-5" x-show="isDropdownOpen" x-cloak />
        @endif
    </div>
</button>
