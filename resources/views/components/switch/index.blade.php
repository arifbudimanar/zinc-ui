@props([
    'id' => null,
    'type' => 'checkbox',
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
])

@php
    $id =
        $id ??
        ($label ??
            ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
    $badge ??= $attributes->has('required') ? 'Required' : null;
    $disabled = $attributes->has('disabled');
@endphp

<x-field variant="inline">
    @if (is_string($label) && $label !== '')
        <x-label for="{{ $id }}" class="w-fit">
            {{ $label }}
            @isset($badge)
                <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
                    {{ $badge }}
                </x-badge>
            @endisset
        </x-label>
    @else
        {{ $label }}
    @endif

    @if (is_string($description) && $description !== '')
        <x-description>
            {{ $description }}
        </x-description>
    @else
        {{ $description }}
    @endif

    <input
        {{ $attributes->merge([
            'id' => $id,
            'type' => $type,
            'disabled' => $disabled,
            'class' => 'peer sr-only hidden',
        ]) }}
        data-switch data-control />

    <x-switch.indicator data-control />


    @if ($label || $description)
        <x-error name="{{ $error }}" />
    @endif
</x-field>
