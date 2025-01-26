@props([
    'id' => null,
    'name' => null,
    'type' => 'radio',
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
])

@php
    $id =
        $id ??
        ($label ??
            ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
    $badge ??= $attributes->has('required') ? 'Required' : null;
    $name ??= $attributes->whereStartsWith('wire:model')->first();
    $disabled = $attributes->has('disabled');
@endphp

@aware(['name' => $name])

<x-with-field :$id :$error :$label :$description :$badge :$badgeColor variant="inline">
    <input
        {{ $attributes->merge([
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'disabled' => $disabled,
            'class' => 'peer sr-only hidden',
        ]) }}
        data-control data-radio>

    <div class="flex size-[1.125rem] mt-px outline-offset-2 rounded-full relative shadow-sm disabled:shadow-none border border-zinc-300 dark:border-white/10 peer-checked:border-transparent bg-white dark:bg-white/10 peer-checked:bg-zinc-800 dark:peer-checked:bg-white peer-disabled:opacity-50"
        x-on:click.prevent="$el.previousElementSibling.click()"
        x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
        x-on:keydown.space.prevent="$el.previousElementSibling.click()"
        :tabindex="$el.previousElementSibling.disabled ? '-1' : '0'"
        :aria-disabled="$el.previousElementSibling.disabled"
        :class="{
            'cursor-pointer': !$el.previousElementSibling.disabled,
            'cursor-default': $el.previousElementSibling.disabled,
        }">
    </div>
    <div class="absolute invisible rounded-full mt-px bg-white pointer-events-none size-2 top-[0.313rem] left-[0.313rem] dark:bg-zinc-800 peer-checked:visible peer-disabled:opacity-50"
        data-radio-indicator>
    </div>
</x-with-field>
