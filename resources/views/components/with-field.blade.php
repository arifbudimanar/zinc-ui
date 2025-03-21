@props([
    'id' => null,
    'label' => null,
    'description' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'error' => null,
])

<?php if ($label || $description): ?>
    <x-field>
        <?php if ($label): ?>
            <x-label :$badge :$badgeColor>{{ $label }}</x-label>
        <?php endif; ?>

        <?php if ($description): ?>
            <x-description>{{ $description }}</x-description>
        <?php endif; ?>

        {{ $slot }}

        <x-error name="{{ $error }}" />
    </x-field>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>
