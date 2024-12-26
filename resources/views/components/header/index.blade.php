@props([
    'container' => false,
    'sticky' => false,
])

@php
    $stickyClass = $sticky ? 'sticky top-0 z-10' : '';
@endphp

@if ($container)
    <div {{ $attributes->merge(['class' => '[grid-area:header] flex items-center min-h-14 w-full' . ' ' . $stickyClass]) }}
        data-header>
        <div class="flex items-center w-full h-full px-6 mx-auto lg:px-8 max-w-7xl">
            {{ $slot }}
        </div>
    </div>
@else
    <div {{ $attributes->merge(['class' => '[grid-area:header] flex items-center min-h-14 px-6 lg:px-8 w-full' . ' ' . $stickyClass]) }}
        data-header>
        {{ $slot }}
    </div>
@endif
