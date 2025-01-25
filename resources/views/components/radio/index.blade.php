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

<x-field
    class="relative [&>[data-label]]:!mb-0 [&>[data-label]:has(+[data-description])]:!mb-0 [&>[data-label]+[data-description]]:!mt-0 [&>[data-label]+[data-description]]:!mb-0 [&>*:not([data-label])+[data-description]]:!mt-0 grid gap-x-3 gap-y-1.5 has-[[data-label]~[data-control]]:grid-cols-[1fr_auto] has-[[data-control]~[data-label]]:grid-cols-[auto_1fr] [&>[data-control]~[data-description]]:row-start-2 [&>[data-control]~[data-description]]:col-start-2 [&>[data-control]~[data-error]]:col-start-2 [&>[data-control]~[data-error]]:col-span-2 [&>[data-control]~[data-error]]:mt-1 [&>[data-label]~[data-control]]:row-start-1 [&>[data-label]~[data-control]]:col-start-2">

    <input
        {{ $attributes->merge([
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'disabled' => $disabled,
            'class' => 'peer sr-only hidden',
        ]) }}
        data-control>

    <div class="flex size-[1.125rem] mt-px outline-offset-2 rounded-full relative cursor-pointer border border-zinc-300 dark:border-white/10 peer-checked:border-transparent bg-white dark:bg-white/10 peer-checked:bg-zinc-800 dark:peer-checked:bg-white peer-disabled:opacity-50"
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
    <div
        class="absolute invisible rounded-full mt-px bg-white pointer-events-none size-2 top-[0.313rem] left-[0.313rem] dark:bg-zinc-800 peer-checked:visible peer-disabled:opacity-50">
    </div>


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

    <x-error name="{{ $error }}" />
</x-field>
