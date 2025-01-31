@props(['active' => null, 'variant' => 'default'])

@php
    $wireModel = $attributes->wire('model')->value();
@endphp

<div {{ $attributes->class('block')->except('wire:model') }} data-tab-group
    x-data="{ selectedTab: {{ $wireModel ? '$wire.entangle(\'' . $wireModel . '\')' : 'null' }} }"
    x-init="selectedTab ||= '{{ $active }}' || $el.querySelector('[data-tab-panel]').getAttribute('aria-label') || '';">
    {{ $slot }}
</div>
