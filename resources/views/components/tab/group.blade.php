@props(['active' => null, 'variant' => 'default'])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
@endphp

<div {{ $attributes->class('block')->except('wire:model') }}
    x-data="{ selectedTab: {{ $wireModel ? '$wire.entangle(\'' . $wireModel . '\')' : 'null' }} }"
    x-init="selectedTab ||= '{{ $active }}' || $el.querySelector('[data-tab-panel]').getAttribute('aria-label') || '';" data-tab-group>
    {{ $slot }}
</div>
