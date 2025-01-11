@props([
    'type' => 'text',
    'variant' => 'outline',
    'resize' => 'auto',
    'rows' => 4,
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
])

@php
    $id = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8));
    $badge = $badge ?? ($attributes->has('required') ? 'Required' : null);

    $required = $attributes->has('required') ? true : false;
    $disabled = $attributes->has('disabled') ? true : false;
    $readonly = $attributes->has('readonly') ? true : false;

    $backgroundClass = [
        'outline' => 'bg-white dark:bg-white/10',
        'filled' => 'bg-zinc-800/5 dark:bg-white/10',
    ][$variant];
    $textClass = [
        'outline' => 'text-zinc-700 dark:text-zinc-300',
        'filled' => 'text-zinc-700 dark:text-zinc-300',
    ][$variant];
    $placeholderClass = [
        'outline' => 'placeholder-zinc-400 dark:placeholder-zinc-400',
        'filled' => 'placeholder-zinc-500 dark:placeholder-white/60',
    ][$variant];
    $shadowClass = [
        'outline' => 'shadow-sm dark:shadow-none',
        'filled' => 'dark:shadow-none',
    ][$variant];
    $borderClass = [
        'outline' => 'border-zinc-200 dark:border-white/10 border-b-zinc-300/80',
        'filled' => 'border-0',
    ][$variant];
    $resizeClass = [
        'horizontal' => 'resize-x',
        'vertical' => 'resize-y',
        'both' => 'resize',
        'none' => 'resize-none',
        'auto' => 'resize-none',
    ][$resize];
    $disabledClass = [
        'outline' =>
            'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:text-zinc-500 dark:disabled:text-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:placeholder-zinc-500 disabled:border-b-zinc-200 dark:disabled:border-white/5',
        'filled' =>
            'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:placeholder-zinc-400 dark:disabled:placeholder-white/40',
    ][$variant];

    $class =
        'block w-full p-3 text-sm border rounded-lg' .
        ' ' .
        $backgroundClass .
        ' ' .
        $textClass .
        ' ' .
        $placeholderClass .
        ' ' .
        $shadowClass .
        ' ' .
        $borderClass .
        ' ' .
        $disabledClass .
        ' ' .
        $resizeClass;
@endphp

<x-with-field :$id :$label :$description :$badge :$badgeColor>
    <textarea
        {{ $attributes->merge([
            'id' => $id,
            'rows' => $rows,
            'class' => $class,
            'required' => $required,
            'disabled' => $disabled,
            'readonly' => $readonly,
        ]) }}
        {{ $resize === 'auto' ? 'x-data x-autosize' : '' }} data-control data-textarea></textarea>
</x-with-field>
