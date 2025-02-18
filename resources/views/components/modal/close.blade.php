@props([
    'name' => null,
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $name = Str::kebab($name ?? $wireModel);
@endphp

@if ($name)
    <div {{ $attributes->class('w-fit')->except('wire:model') }}
        x-data
        x-on:click="$dispatch('close-modal-{{ $name }}')" data-modal-trigger>
        {{ $slot }}
    </div>
@else
    <div {{ $attributes }}
        x-on:click.stop="isModalOpen = false" data-modal-close>
        {{ $slot }}
    </div>
@endif
