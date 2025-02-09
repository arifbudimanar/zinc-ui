@php
    $classes = ZincUi::classes()
        ->add('flex items-center justify-center')
        ->add('mt-px size-[1.125rem] rounded-full outline-offset-2')
        ->add('bg-white dark:bg-white/10 peer-checked:bg-zinc-800 dark:peer-checked:bg-white')
        ->add('border border-zinc-300 dark:border-white/10 peer-checked:border-transparent')
        ->add('shadow-sm disabled:shadow-none peer-checked:shadow-none')
        ->add('peer-checked:[&_[data-indicator]]:block peer-disabled:opacity-50');
@endphp

<div {{ $attributes->class($classes) }}
    x-on:click.prevent="$el.previousElementSibling.click()"
    x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
    x-on:keydown.space.prevent="$el.previousElementSibling.click()"
    x-bind:tabindex="$el.previousElementSibling.disabled ? '-1' : '0'"
    x-bind:aria-disabled="$el.previousElementSibling.disabled ? 'true' : 'false'"
    x-bind:class="{ 'cursor-pointer': !$el.previousElementSibling.disabled, 'cursor-default': $el.previousElementSibling.disabled }"
    data-radio-indicator>
    <div class="pointer-events-none hidden size-2 rounded-full bg-white dark:bg-zinc-800" data-indicator></div>
</div>
