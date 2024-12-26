@props(['label' => null])

<p {{ $attributes->merge(['class' => 'text-sm text-zinc-500 dark:text-white/60']) }} data-description>
    {{ $label ?? $slot }}
</p>
