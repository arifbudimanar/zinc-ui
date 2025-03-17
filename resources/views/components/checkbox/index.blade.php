@props([
    'id' => null,
    'type' => 'checkbox',
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
])

@php
    $id = $id ?? (Str::kebab($label) ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $badge ??= $attributes->has('required') ? __('Required') : null;
    $name ??= $attributes->whereStartsWith('wire:model')->first();
@endphp

<x-with-field variant="inline" :$id :$label :$description :$badge :$badgeColor>
    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type, 'name' => $name]) }} data-checkbox data-control />

    <x-checkbox.indicator />
</x-with-field>
