@props([
    'badge' => null,
    'badgeColor' => 'zinc',
])

@php
    // $badge = $attributes->has('required') ? 'Required' : $badge;
    $disabled = $attributes->has('disabled') ? true : false;
@endphp

<label
    {{ $attributes->merge(['class' => 'block text-sm font-medium select-none text-zinc-800 dark:text-white' . ' ' . ($disabled ? 'opacity-50' : '')]) }}
    data-label>
    {{ $slot }}
    @isset($badge)
        <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
            {{ $badge }}
        </x-badge>
    @endisset
</label>
