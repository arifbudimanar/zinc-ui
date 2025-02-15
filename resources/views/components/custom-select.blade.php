@props([
    'id' => null,
    'multiple' => false,
])

@aware([
    'multiple' => $multiple,
])

@php
    $id = $id ?? 'select-' . Str::random(8);
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $entangledWireModel = $attributes->wire('model')->directive() == 'wire:model.live' ? '$wire.entangle(\'' . $wireModel . '\').live' : '$wire.entangle(\'' . $wireModel . '\')';
@endphp

<div id="{{ $id }}" {{ $attributes->except('wire:model') }}
    x-data="{
        isSelectOpen: false,
        {{ $multiple ? 'selectedOptions' : 'selectedOption' }}: {{ $wireModel ? $entangledWireModel : ($multiple ? '[]' : 'null') }},
        openSelect() {
            this.isSelectOpen = true;
        },
        toggleSelect() {
            this.isSelectOpen = !this.isSelectOpen;
        },
        closeSelect() {
            this.isSelectOpen = false;
        },
    }" x-ref="select"
    x-on:click="toggleSelect"
    x-on:keydown.down.prevent="$focus.next()"
    x-on:keydown.up.prevent="$focus.previous()"
    x-on:keydown.escape="closeSelect" data-custom-select>
    {{ $slot }}
</div>
