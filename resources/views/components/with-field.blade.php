@props([
    'id' => null,
    'label' => null,
    'description' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
])

@if ($label || $description !== null)
    <x-field>
        <x-label>
            {{ $label }}
            @isset($badge)
                <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
                    {{ $badge }}
                </x-badge>
            @endisset
        </x-label>

        <x-description>
            {{ $description }}
        </x-description>

        {{ $slot }}

        <x-error name="{{ $id }}" />
    </x-field>
@else
    <div class="w-full">
        {{ $slot }}
    </div>
@endif
