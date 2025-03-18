@props([
    'id' => null,
    'type' => 'checkbox',
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
    'align' => 'right',
])

@php
    $id = $id ?? (Str::kebab($label) ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
    $badge ??= $attributes->has('required') ? __('Required') : null;
@endphp

<?php if ($align == 'right'): ?>
<x-with-inline-field :$id :$label :$description :$error :$badge :$badgeColor>
    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type]) }} data-switch data-control />

    <x-switch.indicator data-control />
</x-with-inline-field>
<?php elseif ($align == 'left'): ?>
<x-with-reversed-inline-field :$id :$label :$description :$error :$badge :$badgeColor>
    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type]) }} data-switch data-control />

    <x-switch.indicator data-control />
</x-with-reversed-inline-field>
<?php endif; ?>
