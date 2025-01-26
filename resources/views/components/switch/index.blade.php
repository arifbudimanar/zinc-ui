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

<x-field variant="inline">
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

    <div class="relative" data-control>
        <input
            {{ $attributes->merge([
                'id' => $id,
                'type' => $type,
                'disabled' => $disabled,
                'class' => 'peer sr-only hidden',
            ]) }} />

        <div class="peer w-8 h-5 rounded-full appearance-none shadow-sm disabled:shadow-none dark:shadow-none bg-zinc-800/15 dark:bg-transparent peer-checked:bg-black dark:peer-checked:bg-white peer-disabled:opacity-50 dark:border border-zinc-300 dark:border-white/20 peer-checked:border-0 after:absolute peer-disabled:cursor-default focus:outline-1"
            x-on:click.prevent="$el.previousElementSibling.click()"
            x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
            x-on:keydown.space.prevent="$el.previousElementSibling.click()"
            :tabindex="$el.previousElementSibling.disabled ? '-1' : '0'"
            :aria-disabled="$el.previousElementSibling.disabled"
            :class="{
                'cursor-pointer': !$el.previousElementSibling.disabled,
                'cursor-default': $el.previousElementSibling.disabled,
            }"
            data-switch>
        </div>

        <div class="absolute bg-white peer-checked:bg-white dark:peer-checked:bg-zinc-800 pointer-events-none top-[3px] left-[3px] size-3.5 rounded-full transition-all peer-checked:translate-x-3"
            data-switch-indicator>
        </div>
    </div>

    @if ($label || $description)
        <x-error name="{{ $error }}" />
    @endif
</x-field>
