@props([
    'logo' => null,
    'name' => null,
])

<a {{ $attributes->class('h-10 flex items-center gap-2 shrink-0') }} data-brand>
    <?php if (is_string($logo) && $logo !== ''): ?>
        <div class="size-6 rounded overflow-hidden shrink-0">
            <img src="{{ $logo }}" alt="{{ $name ?? config('app.name') }}">
        </div>
    <?php else: ?>
        {{ $logo }}
    <?php endif; ?>

    <?php if (is_string($name) && $name !== ''): ?>
        <div class="text-sm font-medium truncate [:where(&)]:text-zinc-800 [:where(&)]:dark:text-zinc-100">
            {{ $name }}
        </div>
    <?php else: ?>
        {{ $name }}
    <?php endif; ?>

    {{ $slot }}
</a>
