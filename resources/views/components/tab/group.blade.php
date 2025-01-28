@props(['active' => null, 'variant' => 'default'])

@php
    $wireModel = $attributes->wire('model')->value();
@endphp

<div x-data="{
    selectedTab: {{ $wireModel ? '$wire.entangle(\'' . $wireModel . '\')' : 'null' }}
}" x-init="if (selectedTab === null) {
    selectedTab = '{{ $active }}' || $el.querySelector('[role=tab]').getAttribute('name');
}" {{ $attributes->merge(['class' => 'block']) }} data-tab-group>
    {{ $slot }}
</div>
