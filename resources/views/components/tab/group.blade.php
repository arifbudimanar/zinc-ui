@props(['active' => null, 'variant' => 'default'])

@php
    $variantClass = [
        'default' => 'space-y-6',
        'segmented' => 'space-y-3',
    ][$variant];
    $wireModel = $attributes->wire('model')->value();
@endphp

<div x-data="{
    selectedTab: {{ $wireModel ? '$wire.entangle(\'' . $wireModel . '\')' : 'null' }}
}" x-init="if (selectedTab === null) {
    selectedTab = '{{ $active }}' || $el.querySelector('[role=tab]').getAttribute('name');
}"
    {{ $attributes->merge([
            'class' => 'block' . ' ' . $variantClass,
        ])->except('wire:model') }}>

    {{ $slot }}
</div>
