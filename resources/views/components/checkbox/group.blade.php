@props([
    'label' => null,
])

<x-field>
    <x-label>
        {{ $label }}
    </x-label>
    <div
        {{ $attributes->merge(['class' => '[&>[data-field]]:mb-3 [&>[data-field]:has(>[data-description])]:mb-4 [&>[data-field]:last-child]:!mb-0']) }}>
        {{ $slot }}
    </div>
</x-field>
