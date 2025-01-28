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

<x-with-field :$id :$error :$label :$description :$badge :$badgeColor variant="inline">
    <input
        {{ $attributes->merge([
            'id' => $id,
            'type' => $type,
            'disabled' => $disabled,
            'class' => 'peer sr-only hidden',
        ]) }}
        data-control data-checkbox />
    <x-checkbox.indicator />
</x-with-field>
