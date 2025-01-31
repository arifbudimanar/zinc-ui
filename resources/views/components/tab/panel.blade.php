@props(['name', 'variant' => 'default'])

@aware(['variant' => $variant, 'active'])

@if ($variant == 'default')
    <div {{ $attributes->merge(['x-cloak' => $active !== $name]) }} role="tabpanel" aria-label="{{ $name }}"
        x-show="selectedTab === '{{ $name }}'"
        data-tab-panel>
        {{ $slot }}
    </div>
@elseif ($variant == 'segmented')
    <x-card {{ $attributes->merge(['x-cloak' => $active !== $name]) }} role="tabpanel" aria-label="{{ $name }}"
        x-show="selectedTab === '{{ $name }}'"
        data-tab-panel>
        {{ $slot }}
    </x-card>
@endif
