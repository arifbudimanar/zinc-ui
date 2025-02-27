@props([
    'id' => null,
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
    $id = $id ?? ($label ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
    $badge ??= $attributes->has('required') ? __('Required') : null;

    $classes = ZincUi::classes()
        ->add('block w-full p-3 text-sm border rounded-lg')
        ->add(
            // Background ...
            match ($variant) {
                'outline' => 'bg-white dark:bg-white/10',
                'filled' => 'bg-zinc-800/5 dark:bg-white/10',
            },
        )
        ->add(
            // Text ...
            match ($variant) {
                'outline' => 'text-zinc-700 dark:text-zinc-300',
                'filled' => 'text-zinc-700 dark:text-zinc-300',
            },
        )
        ->add(
            // Shadow & Border ...
            match ($variant) {
                'outline' => 'shadow-xs dark:shadow-none border-zinc-200 dark:border-white/10 border-b-zinc-300/80',
                'filled' => 'shadow-none dark:shadow-none border-0',
            },
        )
        ->add(
            // Placeholder ...
            match ($variant) {
                'outline' => 'placeholder-zinc-400 dark:placeholder-zinc-400',
                'filled' => 'placeholder-zinc-500 dark:placeholder-white/60',
            },
        )
        ->add(
            match ($resize) {
                'horizontal' => 'resize-x',
                'vertical' => 'resize-y',
                'both' => 'resize',
                'none' => 'resize-none',
                'auto' => 'resize-none',
            },
        )
        ->add(
            match ($variant) {
                'outline'
                    => 'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:text-zinc-500 dark:disabled:text-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:placeholder-zinc-500 disabled:border-b-zinc-200 dark:disabled:border-white/5',
                'filled' => 'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:placeholder-zinc-400 dark:disabled:placeholder-white/40',
            },
        );
@endphp

<x-with-field :$id :$error :$label :$description :$badge :$badgeColor>
    <textarea id={{ $id }} rows="{{ $rows }}" {{ $attributes->class($classes) }}
        <?php if ($resize == 'auto'): ?> x-data x-autosize <?php endif; ?>
        data-control data-textarea></textarea>
</x-with-field>
