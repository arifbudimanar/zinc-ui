@props([
    'id' => null,
    'name' => null,
    'type' => 'radio',
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
])

@aware(['name' => $name])

@php
    $id = $id ?? ($label ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
    $badge ??= $attributes->has('required') ? __('Required') : null;
    $name ??= $attributes->whereStartsWith('wire:model')->first();
@endphp

<x-with-field variant="inline" :$id :$error :$label :$description :$badge :$badgeColor>
    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type, 'name' => $name]) }} data-radio data-control>

    <x-radio.indicator />
</x-with-field>
