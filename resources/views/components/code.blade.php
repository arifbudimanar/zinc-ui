@php
    $classes = ZincUi::classes()
        ->add('inline-block rounded-md px-1.5 py-[0rem]')
        ->add('font-mono font-medium text-sm whitespace-nowrap')
        ->add('text-zinc-700 dark:text-zinc-200')
        ->add('bg-zinc-600/10 dark:bg-white/15');
@endphp

<span {{ $attributes->class($classes) }} data-code>
    {{ $slot }}
</span>
