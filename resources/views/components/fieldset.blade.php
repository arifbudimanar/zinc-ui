@props([
    'label' => null,
    'description' => null,
])

@php
    $classes = ZincUi::classes()
        ->add('[&>[data-field]]:mb-3 [&>[data-field]:has(>[data-description])]:mb-4 [&>[data-field]:last-child]:!mb-0')
        ->add('[&>legend]:mb-4 [&>legend:has(+[data-description])]:mb-2 [&>legend+[data-description]]:mb-4')
        ->add('[&[disabled]_[data-label]]:opacity-50 [&[disabled]_[data-legend]]:opacity-50');
@endphp

<fieldset {{ $attributes->class($classes) }} data-fieldset>
    <?php if ($label): ?>
        <x-legend>{{ $label }}</x-legend>
    <?php endif; ?>

    <?php if ($description): ?>
        <x-description>{{ $description }}</x-description>
    <?php endif; ?>

    {{ $slot }}
</fieldset>
