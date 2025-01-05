@props(['label'])

<code
    {{ $attributes->merge(['class' => 'font-mono text-[.9rem] text-zinc-600 dark:text-white inline-block whitespace-nowrap rounded-lg px-1.5 py-[0rem] bg-zinc-600/10 dark:bg-white/15']) }}>
    {{ $label ?? $slot }}
</code>
