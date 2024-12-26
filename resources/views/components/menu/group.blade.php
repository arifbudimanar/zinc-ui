@props([
    'heading' => null,
])

<div {{ $attributes->merge(['class' => '-mx-1 px-1 [&+&>[data-menu-separator-top]]:hidden [&:first-child>[data-menu-separator-top]]:hidden [&:last-child>[data-menu-separator-bottom]]:hidden']) }}
    role="group" data-menu-group>
    <x-menu.separator data-menu-separator-top />

    @if ($heading)
        <x-menu.heading>{{ $heading }}</x-menu.heading>
    @endif

    {{ $slot }}

    <x-menu.separator data-menu-separator-bottom />
</div>
