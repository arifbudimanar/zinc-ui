@props(['heading' => null])

@if ($heading !== null)
    <div class="space-y-3">
        <x-sidebar.heading>
            {{ $heading }}
        </x-sidebar.heading>

        <div
            {{ $attributes->merge(['class' => 'text-zinc-500 dark:text-zinc-400 hover:*:text-zinc-800 dark:hover:*:text-white font-medium']) }}>
            {{ $slot }}
        </div>
    </div>
@else
    <div
        {{ $attributes->merge(['class' => 'text-zinc-500 dark:text-zinc-400 hover:*:text-zinc-800 dark:hover:*:text-white font-medium']) }}>
        {{ $slot }}
    </div>
@endif
