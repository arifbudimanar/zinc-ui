@props([
    'badge' => null,
    'badgeColor' => 'zinc',
])

<a {{ $attributes->merge(['class' => 'flex items-center gap-2 py-1 pl-4 border-l-2 first:pt-0 last:pb-0 border-zinc-100 dark:border-zinc-700']) }}
    wire:current.class="font-medium text-zinc-800 dark:text-white border-zinc-800 dark:!border-white">
    {{ $slot }}
    @if ($badge)
        <x-badge color="{{ $badgeColor }}" inset="top bottom">
            {{ $badge }}
        </x-badge>
    @endif
</a>
