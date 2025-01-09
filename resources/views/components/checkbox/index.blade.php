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

    $class = 'flex items-center w-full gap-3 mb-2';
@endphp

<x-field class="{{ $disabled ? 'opacity-50' : '' }}">
    <div class="relative block w-full">
        <div {{ $attributes->merge([
            'class' => $class,
        ]) }}>
            <label class="relative inline-flex items-center -my-2.5">
                <input
                    class="peer relative size-5 appearance-none overflow-hidden rounded-md
                    shadow-sm disabled:shadow-none checked:shadow-none
                    bg-white dark:bg-white/10 checked:before:bg-zinc-800 dark:checked:before:bg-white
                    border border-zinc-300 dark:border-white/10 checked:border-zinc-800 dark:checked:border-white
                    before:absolute before:inset-0 before:content['']
                    cursor-pointer peer-disabled:cursor-default peer-read-only:cursor-default"
                    {{ $attributes->merge([
                        'id' => $id,
                        'type' => $type,
                        'disabled' => $disabled,
                    ]) }} />

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="4"
                    class="absolute invisible text-white -translate-x-1/2 -translate-y-1/2 pointer-events-none left-1/2 top-1/2 size-4 dark:text-zinc-800 peer-checked:visible">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </label>

            <x-label for="{{ $id }}">
                {{ $slot }}
                @isset($badge)
                    <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
                        {{ $badge }}
                    </x-badge>
                @endisset
            </x-label>
        </div>
        @isset($description)
            <x-description class="mb-3 ml-8">
                {{ $description }}
            </x-description>
        @endisset
        <x-error name="{{ $id }}" class="mt-2" />
    </div>
</x-field>
