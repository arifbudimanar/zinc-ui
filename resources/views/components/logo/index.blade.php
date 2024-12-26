@props([
    'logo' => null,
    'name' => null,
])

@php
    $logo = $name ?? $logo;
@endphp

<x-dynamic-component component="{{ 'logo.' . $logo }}" {{ $attributes }} />
