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
    $id = $id ?? (Str::kebab($label) ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $badge ??= $attributes->has('required') ? __('Required') : null;
    $name ??= $attributes->whereStartsWith('wire:model')->first();
@endphp

<x-with-inline-field :$id :$label :$description :$badge :$badgeColor>
    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type, 'name' => $name]) }} data-radio data-control>

    <x-radio.indicator />
</x-with-inline-field>
