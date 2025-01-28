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
    <button type="button"
        {{ $attributes->merge(['class' => 'flex whitespace-nowrap gap-2 items-center h-10 px-2 -mb-px border-b-[2px] border-transparent text-sm font-medium text-zinc-400 dark:text-white/50 hover:text-zinc-800 dark:hover:text-white disabled:opacity-50 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none']) }}
        x-on:click="selectedTab = '{{ $name }}'" x-on:focusin="selectedTab = '{{ $name }}'" role="tab"
        :aria-selected="selectedTab === '{{ $name }}'"
        :tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
        x-bind:class="selectedTab === '{{ $name }}' ?
            '!text-zinc-800 dark:!text-white hover:!text-zinc-800 dark:hover:!text-white !border-zinc-800 dark:!border-white' :
            'text-zinc-400 dark:text-white/50 hover:text-zinc-800 dark:hover:text-white border-transparent'"
        data-tab>
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
    <button type="button"
        {{ $attributes->merge(['class' => 'flex whitespace-nowrap flex-1 justify-center items-center gap-2 rounded-md data-[selected]:shadow-sm text-sm font-medium text-zinc-600 hover:text-zinc-800 dark:hover:text-white dark:text-white/70 data-[selected]:text-zinc-800 data-[selected]:dark:text-white data-[selected]:bg-white data-[selected]:dark:bg-white/20 disabled:opacity-50 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none px-4']) }}
        x-on:click="selectedTab = '{{ $name }}'" x-on:focusin="selectedTab = '{{ $name }}'"
        role="tab" :aria-selected="selectedTab === '{{ $name }}'"
        :tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
        x-bind:class="selectedTab === '{{ $name }}' ?
            '!text-zinc-800 dark:!text-white hover:!text-zinc-800 dark:hover:!text-white !bg-white dark:!bg-white/20' :
            'text-zinc-600 dark:text-white/70 hover:text-zinc-800 dark:hover:text-white'"
        data-tab>
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
