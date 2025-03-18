@props([
    'id' => null,
    'label' => null,
    'description' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'error' => null,
])

<?php if ($label || $description): ?>
    <x-field variant="inline">
        {{ $slot }}

        <?php if ($label): ?>
            <x-label :$badge :$badgeColor for="{{ $id }}" class="w-fit">{{ $label }}</x-label>
        <?php endif; ?>

        <?php if ($description): ?>
            <x-description>{{ $description }}</x-description>
        <?php endif; ?>

        <x-error name="{{ $error }}" class="ml-[2.75rem]" />
    </x-field>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>
