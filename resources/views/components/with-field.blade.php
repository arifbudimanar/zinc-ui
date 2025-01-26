@props([
    'id' => null,
    'label' => null,
    'description' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'error' => null,
    'variant' => 'default',
])

@if ($variant == 'default')
    @if ($label || $description)
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

            <x-error name="{{ $error }}" />
        </x-field>
    @else
        <div class="w-full">
            {{ $slot }}
        </div>
    @endif
@endif

@if ($variant == 'inline')
    @if ($label || $description)
        <x-field variant="inline">
            {{ $slot }}

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
    @else
        <div class="relative">
            {{ $slot }}
        </div>
    @endif
@endif
