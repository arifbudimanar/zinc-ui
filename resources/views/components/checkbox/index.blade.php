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
@endphp

<x-field
    class="relative [&>[data-label]]:!mb-0 [&>[data-label]:has(+[data-description])]:!mb-0 [&>[data-label]+[data-description]]:!mt-0 [&>[data-label]+[data-description]]:!mb-0 [&>*:not([data-label])+[data-description]]:!mt-0 grid gap-x-3 gap-y-1.5 has-[[data-label]~[data-control]]:grid-cols-[1fr_auto] has-[[data-control]~[data-label]]:grid-cols-[auto_1fr] [&>[data-control]~[data-description]]:row-start-2 [&>[data-control]~[data-description]]:col-start-2 [&>[data-control]~[data-error]]:col-span-2 [&>[data-control]~[data-error]]:mt-1 [&>[data-label]~[data-control]]:row-start-1 [&>[data-label]~[data-control]]:col-start-2">
    <input
        {{ $attributes->merge([
            'id' => $id,
            'type' => $type,
            'disabled' => $disabled,
            'class' =>
                "flex mt-px outline-offset-2 peer relative size-[1.125rem] appearance-none overflow-hidden rounded-[0.3rem] shadow-sm disabled:shadow-none checked:shadow-none bg-white dark:bg-white/10 checked:before:bg-zinc-800 dark:checked:before:bg-white border border-zinc-300 dark:border-white/10 checked:border-zinc-800 dark:checked:border-white before:absolute before:inset-0 before:content-[''] cursor-pointer disabled:cursor-default disabled:opacity-50",
        ]) }}
        x-on:keydown.enter.prevent="$el.click()" data-control data-checkbox>

    <x-icon name="c-check"
        class="absolute invisible text-white pointer-events-none size-[1.125rem] top-[0.063rem] left-0 dark:text-zinc-800 peer-checked:visible"
        data-checkbox-indicator />

    @isset($label)
        <x-label for="{{ $id }}" class="">
            {{ $label }}
            @isset($badge)
                <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
                    {{ $badge }}
                </x-badge>
            @endisset
        </x-label>
    @endisset

    @isset($description)
        <x-description>
            {{ $description }}
        </x-description>
    @endisset

    <x-error name="{{ $id }}" />
</x-field>
