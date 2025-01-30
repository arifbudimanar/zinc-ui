@props(['name', 'variant' => 'default'])

@aware(['variant' => $variant, 'active'])

@if ($variant == 'default')
    <div role="tabpanel" aria-label="{{ $name }}" x-show="selectedTab === '{{ $name }}'"
        {{ $attributes->merge(['x-cloak' => $active !== $name]) }} data-tab-panel>
        {{ $slot }}
    </div>
@elseif ($variant == 'segmented')
    <x-card role="tabpanel" aria-label="{{ $name }}" x-show="selectedTab === '{{ $name }}'"
        {{ $attributes->merge(['x-cloak' => $active !== $name]) }} data-tab-panel>
        {{ $slot }}
    </x-card>
@endif
