@props([
    'type' => 'checkbox',
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
])

@php
    $id = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8));
    $badge = $badge ?? ($attributes->has('required') ? 'Required' : null);
    $disabled = $attributes->has('disabled') ? true : false;
    $readonly = $attributes->has('readonly') ? true : false;
@endphp

<x-field
    class="relative [&>[data-label]]:!mb-0 [&>[data-label]:has(+[data-description])]:!mb-0 [&>[data-label]+[data-description]]:!mt-0 [&>[data-label]+[data-description]]:!mb-0 [&>*:not([data-label])+[data-description]]:!mt-0 grid gap-x-3 gap-y-1.5 has-[[data-label]~[data-control]]:grid-cols-[1fr_auto] has-[[data-control]~[data-label]]:grid-cols-[auto_1fr] [&>[data-control]~[data-description]]:row-start-2 [&>[data-control]~[data-description]]:col-start-2 [&>[data-control]~[data-error]]:col-span-2 [&>[data-control]~[data-error]]:mt-1 [&>[data-label]~[data-control]]:row-start-1 [&>[data-label]~[data-control]]:col-start-2">
    @if (is_string($label) && $label !== '')
        <x-label for="{{ $id }}" class="w-fit">
            {{ $label }}
            @isset($badge)
                <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
                    {{ $badge }}
                </x-badge>
            @endisset
        </x-label>
    @else
        {{ $label }}
    @endif

    @if (is_string($description) && $description !== '')
        <x-description>
            {{ $description }}
        </x-description>
    @else
        {{ $description }}
    @endif

    <label class="relative" data-control data-switch>
        <input
            {{ $attributes->merge([
                'id' => $id,
                'type' => $type,
                'disabled' => $disabled,
                'readonly' => $readonly,
                'class' => 'peer sr-only hidden',
            ]) }}
            data-control>

        <div x-on:click.prevent="$el.previousElementSibling.click()"
            x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
            x-on:keydown.space.prevent="$el.previousElementSibling.click()"
            :tabindex="$el.previousElementSibling.disabled ? '-1' : '0'"
            :aria-disabled="$el.previousElementSibling.disabled"
            :class="{
                'cursor-pointer': !$el.previousElementSibling.disabled,
                'cursor-default': $el.previousElementSibling.disabled,
            }"
            class="peer w-8 h-5 rounded-full appearance-none shadow-sm disabled:shadow-none dark:shadow-none
            bg-zinc-300 dark:bg-transparent peer-checked:bg-black dark:peer-checked:bg-white peer-disabled:opacity-50
            dark:border border-zinc-300 dark:border-zinc-600 peer-checked:border-0
            after:absolute after:content-[''] after:top-[3px] after:left-[3px] after:h-3.5 after:w-3.5
            after:rounded-full after:transition-all peer-checked:after:translate-x-3
            after:bg-white dark:after:peer-checked:bg-zinc-800 cursor-pointer peer-disabled:cursor-default focus:outline-1">
        </div>
    </label>

    <x-error name="{{ $id }}" />
</x-field>
