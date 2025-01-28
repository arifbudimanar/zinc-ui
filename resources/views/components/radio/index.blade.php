@props([
    'id' => null,
    'name' => null,
    'type' => 'radio',
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
    $name ??= $attributes->whereStartsWith('wire:model')->first();
    $disabled = $attributes->has('disabled');
@endphp

@aware(['name' => $name])

<x-with-field :$id :$error :$label :$description :$badge :$badgeColor variant="inline">
    <input
        {{ $attributes->merge([
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'disabled' => $disabled,
            'class' => 'peer sr-only hidden',
        ]) }}
        data-control data-radio>
    <x-radio.indicator />
</x-with-field>
