@props([
    'name' => null,
])

<?php if ($errors->has($name)): ?>
    <div {{ $attributes->class('mt-3 text-sm font-medium text-red-500 dark:text-red-400') }} data-error>
        <x-icon name="m-exclamation-triangle" class="size-5 shrink-0 text-inherite inline" />

        {{ $errors->first($name) }}
    </div>
<?php endif; ?>
