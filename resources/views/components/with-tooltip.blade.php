@props([
    'tooltip' => null,
    'tooltipPosition' => 'top',
    'tooltipOffset' => 6,
    'tooltipKbd' => null,
])

<?php if ($tooltip): ?>
    <x-tooltip {{ $attributes }} :content="$tooltip" :position="$tooltipPosition" :offset="$tooltipOffset" :kbd="$tooltipKbd">
        {{ $slot }}
    </x-tooltip>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>
