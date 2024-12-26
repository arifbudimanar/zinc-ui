@props([
    'name' => null,
])

@error($name)
    <p {{ $attributes->merge(['class' => 'mt-3 text-sm font-medium text-red-500 dark:text-red-400']) }} data-error>
        {{ $message }}
    </p>
@enderror
