@props([
    'badge' => null,
    'badgeColor' => 'zinc',
])

@php
    $badge ??= $attributes->has('required') ? __('Required') : null;
@endphp

<label {{ $attributes->class('block text-sm font-medium select-none text-zinc-800 dark:text-white') }} aria-hidden="true" data-label>
    {{ $slot }}

    <?php if ($badge != null): ?>
        <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
            {{ $badge }}
        </x-badge>
    <?php endif; ?>
</label>
