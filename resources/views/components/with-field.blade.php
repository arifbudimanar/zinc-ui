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
                <x-badge label="{{ $badge }}" color="{{ $badgeColor }}" class="ml-1.5 -my-2.5" />
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
