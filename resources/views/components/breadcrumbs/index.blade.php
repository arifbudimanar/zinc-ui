@props([
    'separator' => 'chevron-right',
])

<div {{ $attributes->class('flex') }} data-breadcrumbs>
    {{ $slot }}
</div>
