@props([
    'name' => null,
    'message' => null,
])

@php
    $message ??= $name ? $errors->first($name) : null;
    $classes = ZincUi::classes('mt-3 text-sm font-medium text-red-500 dark:text-red-400')
        ->add($message ? '' : 'hidden');
@endphp


<div {{ $attributes->class($classes) }} data-error>
    <?php if ($message): ?>
        <x-icon name="m-exclamation-triangle" class="size-5 shrink-0 text-inherite inline mr-1.5" />
    
        {{ $message }}
    <?php endif; ?>
</div>
