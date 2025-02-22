@props([
    'name' => null,
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $name = Str::kebab($name ?? $wireModel);
@endphp

<div {{ $attributes->class('[:where(&)]:w-fit')->except('wire:model') }}
    x-data x-on:click="$dispatch('open-modal-{{ $name }}')" data-modal-trigger>
    {{ $slot }}
</div>
