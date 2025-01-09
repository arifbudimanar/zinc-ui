@props([
    'separator' => 'chevron-right',
])

<div {{ $attributes->merge(['class' => 'flex']) }} data-breadcrumbs>
    {{ $slot }}
</div>
