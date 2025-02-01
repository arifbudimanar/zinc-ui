<div {{ $attributes->class('relative mt-px flex size-[1.125rem] items-center justify-center rounded-full border border-zinc-300 bg-white shadow-sm outline-offset-2 disabled:shadow-none peer-checked:border-transparent peer-checked:bg-zinc-800 peer-checked:shadow-none peer-disabled:opacity-50 dark:border-white/10 dark:bg-white/10 dark:peer-checked:bg-white peer-checked:[&_[data-indicator]]:block') }}
    x-on:click.prevent="$el.previousElementSibling.click()"
    x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
    x-on:keydown.space.prevent="$el.previousElementSibling.click()"
    x-bind:tabindex="$el.previousElementSibling.disabled ? '-1' : '0'"
    x-bind:aria-disabled="$el.previousElementSibling.disabled ? 'true' : 'false'"
    x-bind:class="{ 'cursor-pointer': !$el.previousElementSibling.disabled, 'cursor-default': $el.previousElementSibling.disabled }"
    data-radio-indicator>
    <div class="pointer-events-none hidden size-2 rounded-full bg-white dark:bg-zinc-800" data-indicator></div>
</div>
