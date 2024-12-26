<div {{ $attributes->merge(['class' => 'px-3 py-2']) }}>
    <div class="text-sm font-medium leading-none text-zinc-400">
        {{ $slot }}
    </div>
</div>
