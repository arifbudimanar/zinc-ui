@props([
    'id' => null,
    'label' => null,
    'description' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'error' => null,
    'variant' => 'default',
])

<?php if ($variant == 'default'): ?>
    <?php if ($label || $description): ?>
        <x-field>
            <?php if ($label): ?>
                <x-label>
                    {{ $label }}
                    <?php if ($badge != null): ?>
                        <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
                            {{ $badge }}
                        </x-badge>
                    <?php endif; ?>
                </x-label>
                <?php if ($description): ?>
                    <x-description>
                        {{ $description }}
                    </x-description>
               <?php endif; ?>
           <?php endif; ?>

            {{ $slot }}

            <x-error name="{{ $error }}" />
        </x-field>
    <?php else: ?>
        <div class="w-full">
            {{ $slot }}
        </div>
   <?php endif; ?>
<?php elseif ($variant == 'inline'): ?>
    <?php if ($label || $description): ?>
        <x-field variant="inline">
            {{ $slot }}

            <?php if (is_string($label) && $label !== ''): ?>
                <x-label for="{{ $id }}" class="w-fit">
                    {{ $label }}
                    <?php if ($badge != null): ?>
                        <x-badge size="sm" color="{{ $badgeColor }}" inset="top bottom" class="ml-1.5">
                            {{ $badge }}
                        </x-badge>
                    <?php endif; ?>
                </x-label>
            <?php else: ?>
                {{ $label }}
           <?php endif; ?>

            <?php if (is_string($description) && $description !== ''): ?>
                <x-description>
                    {{ $description }}
                </x-description>
            <?php else: ?>
                {{ $description }}
           <?php endif; ?>

            <x-error name="{{ $error }}" />
        </x-field>
    <?php else: ?>
        <div class="relative">
            {{ $slot }}
        </div>
   <?php endif; ?>
<?php endif; ?>
