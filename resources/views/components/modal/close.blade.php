@props([
    'name' => null,
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $name = Str::kebab($name ?? $wireModel);
@endphp

<?php if ($name): ?>
    <div {{ $attributes->class('[:where(&)]:w-fit')->except('wire:model') }}
        x-data x-on:click="$dispatch('close-modal-{{ $name }}')" data-modal-close>
        {{ $slot }}
    </div>
<?php else: ?>
    <div {{ $attributes->class('[:where(&)]:w-fit')->except('wire:model') }}
        x-on:click.stop="isModalOpen = false" data-modal-close>
        {{ $slot }}
    </div>
<?php endif; ?>
