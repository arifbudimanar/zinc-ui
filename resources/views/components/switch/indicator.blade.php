<div class="w-8 h-5 rounded-full flex items-center appearance-none shadow-sm disabled:shadow-none dark:shadow-none bg-zinc-800/15 dark:bg-transparent peer-checked:bg-black dark:peer-checked:bg-white peer-disabled:opacity-50 dark:border border-zinc-300 dark:border-white/20 peer-checked:border-0 peer-checked:[&_[data-indicator]]:translate-x-3 peer-checked:dark:[&_[data-indicator]]:bg-black"
    x-on:click.prevent="$el.previousElementSibling.click()"
    x-on:keydown.enter.prevent="$el.previousElementSibling.click()"
    x-on:keydown.space.prevent="$el.previousElementSibling.click()"
    :tabindex="$el.previousElementSibling.disabled ? '-1' : '0'" :aria-disabled="$el.previousElementSibling.disabled"
    :class="{
        'cursor-pointer': !$el.previousElementSibling.disabled,
        'cursor-default': $el.previousElementSibling.disabled,
    }"
    {{ $attributes->merge(['data-switch-indicator']) }}>
    <div class="bg-white size-3.5 rounded-full ml-[0.188rem] transition-all" data-indicator></div>
</div>
