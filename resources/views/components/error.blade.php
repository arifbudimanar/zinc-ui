@props([
    'name' => null,
])

<?php if ($errors->has($name)): ?>
    <p {{ $attributes->class('mt-3 text-sm font-medium text-red-500 dark:text-red-400') }} data-error>
        {{ $errors->first($name) }}
    </p>
<?php endif; ?>
