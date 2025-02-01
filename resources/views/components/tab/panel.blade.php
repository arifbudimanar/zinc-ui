@props(['name', 'variant' => 'default'])

@aware(['variant' => $variant, 'active'])

<?php if ($variant == 'default'): ?>
    <div role="tabpanel" aria-label="{{ $name }}" {{ $attributes->merge(['x-cloak' => $active !== $name]) }}
        x-show="selectedTab === '{{ $name }}'" data-tab-panel>
        {{ $slot }}
    </div>
<?php elseif ($variant == 'segmented'): ?>
    <x-card role="tabpanel" aria-label="{{ $name }}" {{ $attributes->merge(['x-cloak' => $active !== $name]) }}
        x-show="selectedTab === '{{ $name }}'" data-tab-panel>
        {{ $slot }}
    </x-card>
<?php endif; ?>
