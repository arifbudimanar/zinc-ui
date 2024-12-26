@props([
    'text' => null,
    'badge' => null,
])

@php
    $badge = $attributes->has('required') ? 'Required' : $badge;
    $disabled = $attributes->has('disabled') ? true : false;
@endphp

<label
    {{ $attributes->merge(['class' => 'block text-sm font-medium select-none text-zinc-800 dark:text-white' . ' ' . ($disabled ? 'opacity-50' : '')]) }}
    data-label>
    @isset($text)
        <span>
            {{ $text }}
            @isset($badge)
                <x-badge class="ml-1.5 -my-2.5">
                    {{ $badge }}
                </x-badge>
            @endisset
        </span>
    @endisset
    {{ $slot }}
</label>
