@props([
    'label' => null,
])

<x-field>
    <x-label>
        {{ $label }}
    </x-label>

    <div {{ $attributes->class('[&>[data-field]]:mb-3 [&>[data-field]:has(>[data-description])]:mb-4 [&>[data-field]:last-child]:!mb-0') }} data-checkbox-group>
        {{ $slot }}
    </div>
</x-field>
