<div {{ $attributes->class('flex h-5 w-8 appearance-none items-center rounded-full border-zinc-300 bg-zinc-800/15 shadow-sm disabled:shadow-none peer-checked:border-0 peer-checked:bg-black peer-disabled:opacity-50 dark:border dark:border-white/20 dark:bg-transparent dark:shadow-none dark:peer-checked:bg-white peer-checked:[&_[data-indicator]]:translate-x-3 peer-checked:dark:[&_[data-indicator]]:bg-black') }}
    x-on:click.prevent="$el.previousElementSibling.click()"
    x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
    x-on:keydown.space.prevent="$el.previousElementSibling.click()"
    x-bind:tabindex="$el.previousElementSibling.disabled ? '-1' : '0'"
    x-bind:aria-disabled="$el.previousElementSibling.disabled ? 'true' : 'false'"
    x-bind:class="{ 'cursor-pointer': !$el.previousElementSibling.disabled, 'cursor-default': $el.previousElementSibling.disabled }"
    data-switch-indicator>
    <div class="ml-[0.188rem] size-3.5 rounded-full bg-white transition-all" data-indicator></div>
</div>
