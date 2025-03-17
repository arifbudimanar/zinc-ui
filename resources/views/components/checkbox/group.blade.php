@props([
    'label' => null,
    'description' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'error' => null,
    'variant' => 'default',
    'name' => null,
])

@php
    $badge ??= $attributes->has('required') ? __('Required') : null;
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
@endphp

<x-with-field :$label :$description :$error :$badge :$badgeColor>
    <div {{ $attributes->class('[&>[data-field]]:mb-3 [&>[data-field]:has(>[data-description])]:mb-4 [&>[data-field]:last-child]:!mb-0')->except('wire:model') }} data-checkbox-group>
        {{ $slot }}
    </div>
</x-with-field>
