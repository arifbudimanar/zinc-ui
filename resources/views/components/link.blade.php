@props(['label', 'variant' => 'default', 'as' => 'link'])

@php
    $classes = [
        'default' =>
            'inline text-inherit font-medium text-zinc-800 dark:text-white underline underline-offset-[6px] decoration-zinc-800/20 dark:decoration-white/20 hover:decoration-current dark:hover:decoration-current',
        'subtle' =>
            'inline text-inherit font-medium text-zinc-500 dark:text-white/70 hover:text-zinc-800 dark:hover:text-white',
    ][$variant];
@endphp

@if ($as == 'link')
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $label ?? $slot }}
    </a>
@endif

@if ($as == 'button')
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $label ?? $slot }}
    </button>
@endif
