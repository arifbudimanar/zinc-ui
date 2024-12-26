<a {{ $attributes->merge(['href' => '/', 'class' => 'h-10 flex items-center gap-2 shrink-0']) }} wire:navigate>
    <x-logo name="zinc-ui" class="overflow-hidden size-6 shrink-0" />

    <h3 class="text-sm font-medium truncate text-zinc-900 dark:text-zinc-100">
        {{ config('app.name') }}
    </h3>
</a>
