@props([
    'transition' => false,
])

<div {{ $attributes->class('block') }} data-accordion>
    {{ $slot }}
</div>
