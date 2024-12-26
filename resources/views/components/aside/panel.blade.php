@props(['variant' => 'subtle'])

<x-card :$variant {{ $attributes->merge(['class' => 'flex-1']) }} data-aside-panel>
    {{ $slot }}
</x-card>
