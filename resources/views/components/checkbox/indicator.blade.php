<div class="size-[1.125rem] mt-px outline-offset-2 rounded-[0.3rem] relative shadow-sm peer-checked:shadow-none disabled:shadow-none border border-zinc-300 dark:border-white/10 flex items-center justify-center peer-checked:border-transparent bg-white dark:bg-white/10 peer-checked:bg-zinc-800 dark:peer-checked:bg-white peer-disabled:opacity-50 peer-checked:[&_[data-indicator]]:block"
    x-on:click.prevent="$el.previousElementSibling.click()"
    x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
    x-on:keydown.space.prevent="$el.previousElementSibling.click()"
    :tabindex="$el.previousElementSibling.disabled ? '-1' : '0'" :aria-disabled="$el.previousElementSibling.disabled"
    :class="{
        'cursor-pointer': !$el.previousElementSibling.disabled,
        'cursor-default': $el.previousElementSibling.disabled,
    }"
    data-checkbox-indicator>
    <x-icon name="c-check" class="size-[1.125rem] hidden text-white pointer-events-none dark:text-zinc-800"
        data-indicator />
</div>
