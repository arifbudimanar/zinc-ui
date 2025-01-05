@props(['name', 'variant' => 'default'])

@aware(['variant' => $variant, 'active'])

{{-- @dump($variant, $active) --}}

<x-card variant="{{ $variant == 'segmented' ? 'default' : 'subtle' }}" role="tabpanel" aria-label="{{ $name }}"
    x-show="selectedTab === '{{ $name }}'" {{ $attributes->merge(['x-cloak' => $active !== $name]) }}>
    {{ $slot }}
</x-card>
