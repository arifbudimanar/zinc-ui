@props(['transition' => false])

<div {{ $attributes->merge(['class' => 'block']) }} data-accordion>
    {{ $slot }}
</div>
