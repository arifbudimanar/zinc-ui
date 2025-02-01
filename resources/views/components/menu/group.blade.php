@props([
    'heading' => null,
])

<div role="group" {{ $attributes->class('-mx-1 px-1 [&+&>[data-menu-separator-top]]:hidden [&:first-child>[data-menu-separator-top]]:hidden [&:last-child>[data-menu-separator-bottom]]:hidden') }}
    data-menu-group>
    <x-menu.separator data-menu-separator-top />

    <?php if ($heading): ?>
        <x-menu.heading>{{ $heading }}</x-menu.heading>
    <?php endif; ?>

    {{ $slot }}

    <x-menu.separator data-menu-separator-bottom />
</div>
