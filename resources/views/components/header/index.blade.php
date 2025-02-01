@props([
    'container' => false,
    'sticky' => false,
])

@php
    $stickyClasses = $sticky && 'sticky top-0 z-10';
@endphp

<?php if ($container): ?>
    <div {{ $attributes->class('[grid-area:header] flex items-center min-h-14 w-full' . ' ' . $stickyClasses) }} data-header>
        <div class="mx-auto flex h-full w-full max-w-7xl items-center px-6 lg:px-8">
            {{ $slot }}
        </div>
    </div>
<?php else: ?>
    <div {{ $attributes->class('[grid-area:header] flex items-center min-h-14 px-6 lg:px-8 w-full' . ' ' . $stickyClasses) }} data-header>
        {{ $slot }}
    </div>
<?php endif; ?>
