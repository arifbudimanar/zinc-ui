@props([
    'id' => null,
    'label' => null,
    'description' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
])

@if ($label !== null || $description !== null)
    <x-field>
        @if ($label)
            <x-label>
                {{ $label }}
                @isset($badge)
                    <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
                        {{ $badge }}
                    </x-badge>
                @endisset
            </x-label>
            @if ($description)
                <x-description>
                    {{ $description }}
                </x-description>
            @endif
        @endif

        {{ $slot }}

        <x-error name="{{ $id }}" />
    </x-field>
@else
    <div class="w-full">
        {{ $slot }}
    </div>
@endif
