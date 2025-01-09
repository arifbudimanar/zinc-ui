@props([
    'href' => null,
    'separator' => 'chevron-right',
    'icon' => null,
])

@aware(['separator' => $separator])

<div class="flex items-center text-sm font-medium group/breadcrumb" data-breadcrumbs-item>
    @if ($href)
        <a
            {{ $attributes->merge(['class' => 'text-zinc-800 dark:text-white hover:underline decoration-zinc-800/20 underline-offset-4', 'href' => $href]) }}>
            @if ($icon)
                <x-icon name="{{ $icon }}" class="size-5 shrink-0" />
            @else
                {{ $slot }}
            @endif
        </a>
    @else
        <div {{ $attributes->merge(['class' => 'text-gray-500 dark:text-white/80']) }}>
            @if ($icon)
                <x-icon name="{{ $icon }}" class="size-5 shrink-0" />
            @else
                {{ $slot }}
            @endif
        </div>
    @endif

    @if ($separator === 'chevron-right')
        <x-icon name="o-chevron-right"
            class="mx-2 shrink-0 size-4 text-zinc-300 dark:text-white/80 group-last/breadcrumb:hidden" />
    @elseif ($separator === 'slash')
        <x-icon name="o-slash"
            class="mx-2 shrink-0 size-4 text-zinc-300 dark:text-white/80 group-last/breadcrumb:hidden" />
    @endif
</div>
