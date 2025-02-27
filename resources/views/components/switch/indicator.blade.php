@php
    $classes = ZincUi::classes()
        ->add('flex items-center')
        ->add('h-5 w-8 rounded-full outline-offset-2')
        ->add('bg-zinc-800/15 dark:bg-transparent peer-checked:bg-black dark:peer-checked:bg-white')
        ->add('dark:border border-zinc-300 dark:border-white/20 peer-checked:border-0')
        ->add('shadow-xs dark:shadow-none disabled:shadow-none')
        ->add('peer-checked:[&_[data-indicator]]:translate-x-3 peer-checked:dark:[&_[data-indicator]]:bg-black peer-disabled:opacity-50');
@endphp

<div {{ $attributes->class($classes) }}
    x-on:click.prevent="$el.previousElementSibling.click()"
    x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
    x-on:keydown.space.prevent="$el.previousElementSibling.click()"
    x-bind:tabindex="$el.previousElementSibling.disabled ? '-1' : '0'"
    x-bind:aria-disabled="$el.previousElementSibling.disabled ? 'true' : 'false'"
    x-bind:class="{ 'cursor-pointer': !$el.previousElementSibling.disabled, 'cursor-default': $el.previousElementSibling.disabled }"
    data-switch-indicator>
    <div class="pointer-events-none ml-[0.188rem] size-3.5 rounded-full bg-white transition-all" data-indicator></div>
</div>
