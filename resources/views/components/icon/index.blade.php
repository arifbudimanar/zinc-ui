@props([
    'icon' => null,
    'name' => null,
])

@php
    $icon = $name ?? $icon;
@endphp

<x-dynamic-component component="{{ 'icon.' . $icon }}" {{ $attributes }} />
