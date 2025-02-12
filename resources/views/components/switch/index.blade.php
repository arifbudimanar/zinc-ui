@props([
    'id' => null,
    'type' => 'checkbox',
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
])

@php
    $id = $id ?? ($label ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
    $badge ??= $attributes->has('required') ? __('Required') : null;
@endphp

<x-field variant="inline">
    <?php if (is_string($label) && $label !== ''): ?>
    <x-label for="{{ $id }}" class="w-fit">
        {{ $label }}
        <?php if ($badge != null): ?>
        <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
            {{ $badge }}
        </x-badge>
        <?php endif; ?>
    </x-label>
    <?php else: ?>
    {{ $label }}
    <?php endif; ?>

    <?php if (is_string($description) && $description !== ''): ?>
    <x-description>
        {{ $description }}
    </x-description>
    <?php else: ?>
    {{ $description }}
    <?php endif; ?>

    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type]) }} data-switch data-control />

    <x-switch.indicator data-control />

    <?php if ($label || $description): ?>
    <x-error name="{{ $error }}" />
    <?php endif; ?>
</x-field>
