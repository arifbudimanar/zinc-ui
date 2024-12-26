<div {{ $attributes->merge([
    'class' =>
        'p-2 pb-1 w-full flex items-center text-left text-xs font-medium text-zinc-500 font-medium dark:text-zinc-300',
]) }}
    data-menu-heading>
    <div class="w-7 hidden [[data-menu]:has([data-menu-item-icon])_&]:block"></div>

    <div>{{ $slot }}</div>
</div>
