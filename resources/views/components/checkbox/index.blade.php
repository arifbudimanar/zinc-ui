@props([
    'id' => null,
    'type' => 'checkbox',
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
    $disabled = $attributes->has('disabled');
@endphp

<x-with-field :$id :$error :$label :$description :$badge :$badgeColor variant="inline">
    <input
        {{ $attributes->merge([
            'id' => $id,
            'type' => $type,
            'disabled' => $disabled,
            'class' => 'peer sr-only hidden',
        ]) }}
        data-control />

    <div class="size-[1.125rem] mt-px outline-offset-2 rounded-[0.3rem] relative shadow-sm disabled:shadow-none border border-zinc-300 dark:border-white/10 peer-checked:border-transparent bg-white dark:bg-white/10 peer-checked:bg-zinc-800 dark:peer-checked:bg-white peer-disabled:opacity-50"
        x-on:click.prevent="$el.previousElementSibling.click()"
        x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
        x-on:keydown.space.prevent="$el.previousElementSibling.click()"
        :tabindex="$el.previousElementSibling.disabled ? '-1' : '0'"
        :aria-disabled="$el.previousElementSibling.disabled"
        :class="{
            'cursor-pointer': !$el.previousElementSibling.disabled,
            'cursor-default': $el.previousElementSibling.disabled,
        }"
        data-checkbox>
    </div>

    <x-icon name="c-check"
        class="absolute invisible text-white pointer-events-none size-[1.125rem] top-[0.063rem] left-0 dark:text-zinc-800 peer-checked:visible"
        data-checkbox-indicator />
</x-with-field>
