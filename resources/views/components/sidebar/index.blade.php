@props([
    'sticky' => false,
    'transition' => false,
])

@php
    $stickyClass = $sticky ? 'fixed top-0 z-20' : '';
@endphp

<div {{ $attributes->merge(['class' => '[grid-area:sidebar] flex flex-col w-64 max-w-64 gap-4 p-4 overflow-y-auto min-h-dvh max-h-dvh overscroll-contain' . ' ' . $stickyClass]) }}
    @if ($transition) x-transition:enter="transition ease-out duration-50 transform"
    x-transition:enter-start="translate-x-[-100%]" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-50 transform" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-[-100%]" @endif
    data-sidebar>
    {{ $slot }}
</div>
