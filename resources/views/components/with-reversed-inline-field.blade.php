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
        <?php if ($label): ?>
            <x-label :$badge :$badgeColor for="{{ $id }}" class="w-fit">{{ $label }}</x-label>
        <?php endif; ?>
        
        <?php if ($description): ?>
            <x-description>{{ $description }}</x-description>
        <?php endif; ?>
            
        {{ $slot }}

        <x-error name="{{ $error }}"/>
    </x-field>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>