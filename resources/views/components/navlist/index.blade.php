@props([
    'variant' => 'outline',
])

<nav {{ $attributes->class('flex flex-col overflow-visible min-h-auto') }} data-navlist>
    {{ $slot }}
</nav>
