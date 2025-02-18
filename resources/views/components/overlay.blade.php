<div {{ $attributes->class('fixed inset-0 bg-zinc-400/20 dark:bg-black/20 [:where(&)]:z-10') }}
    x-transition:enter="ease-out duration-100"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-50"
    x-transition:leave="ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak data-overlay></div>
