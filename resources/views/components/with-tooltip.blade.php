@props([
    'tooltip' => null,
    'tooltipPosition' => 'top',
    'tooltipOffset' => 6,
    'tooltipKbd' => null,
])

@if ($tooltip)
    <x-tooltip {{ $attributes }} :content="$tooltip" :position="$tooltipPosition" :offset="$tooltipOffset" :kbd="$tooltipKbd">
        {{ $slot }}
    </x-tooltip>
@else
    {{ $slot }}
@endif
