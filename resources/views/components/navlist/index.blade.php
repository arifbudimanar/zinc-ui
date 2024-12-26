@props([
    'variant' => 'outline',
])

<div {{ $attributes->merge(['class' => 'flex flex-col overflow-visible min-h-auto']) }}>
    {{ $slot }}
</div>
