@props([
    'variant' => 'default',
    'name' => null,
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'label' => null,
])

@aware(['variant' => $variant, 'active'])

@php
    $iconLeading = $icon ??= $iconLeading;
@endphp

@if ($variant === 'default')
    <button type="button" x-on:click="selectedTab = '{{ $name }}'" role="tab"
        :aria-selected="selectedTab === '{{ $name }}'"
        :tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
        class="flex items-center h-10 gap-2 px-2 -mb-px text-sm font-medium border-b-[2px] whitespace-nowrap text-zinc-400 dark:text-white/50 hover:text-zinc-800 dark:hover:text-white border-transparent disabled:opacity-50 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none"
        :class="selectedTab === '{{ $name }}' ?
            '!text-zinc-800 dark:!text-white hover:!text-zinc-800 dark:hover:!text-white !border-zinc-800 dark:!border-white' :
            'text-zinc-400 dark:text-white/50 hover:text-zinc-800 dark:hover:text-white border-transparent'"
        {{ $attributes }}>
        @if (is_string($iconLeading))
            <x-icon :name="$iconLeading" class="shrink-0 size-5" />
        @else
            {{ $iconLeading }}
        @endif

        {{ $label ?? $slot }}

        @if (is_string($iconTrailing))
            <x-icon :name="$iconTrailing" class="shrink-0 size-5" />
        @else
            {{ $iconTrailing }}
        @endif
    </button>
@endif

@if ($variant === 'segmented')
    <button type="button" x-on:click="selectedTab = '{{ $name }}'" role="tab"
        :aria-selected="selectedTab === '{{ $name }}'"
        :tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
        class="flex items-center justify-center flex-1 h-8 gap-2 px-4 text-sm font-medium rounded-md snap-center group whitespace-nowrap text-zinc-600 dark:text-white/70 hover:text-zinc-800 dark:hover:text-white disabled:opacity-50 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none"
        :class="selectedTab === '{{ $name }}' ?
            '!text-zinc-800 dark:!text-white hover:!text-zinc-800 dark:hover:!text-white !bg-white dark:!bg-white/20' :
            'text-zinc-600 dark:text-white/70 hover:text-zinc-800 dark:hover:text-white'"
        {{ $attributes }}>
        @if (is_string($iconLeading))
            <x-icon :name="$iconLeading" class="shrink-0 size-5" />
        @else
            {{ $iconLeading }}
        @endif

        {{ $label ?? $slot }}

        @if (is_string($iconTrailing))
            <x-icon :name="$iconTrailing" class="shrink-0 size-5" />
        @else
            {{ $iconTrailing }}
        @endif
    </button>
@endif
