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
    $badge ??= $attributes->has('required') ? 'Required' : null;
@endphp

<x-with-field variant="inline" :$id :$error :$label :$description :$badge :$badgeColor>
    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type]) }} data-checkbox data-control />
    <x-checkbox.indicator />
</x-with-field>
