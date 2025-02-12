@props([
    'id' => null,
    'type' => 'text',
    'variant' => 'outline',
    'size' => 'base',
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => 'm-chevron-up-down',
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
    'description' => null,
    'placeholder' => null,
])

@php
    $id = $id ?? ($label ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
    $badge ??= $attributes->has('required') ? __('Required') : null;
    $iconLeading = $icon ??= $iconLeading;
    $placeholder = $placeholder ?? ($attributes->has('multiple') ? __('Select options...') : __('Select an option...'));

    $classes = ZincUi::classes()
        ->add('appearance-none w-full block')
        ->add($iconLeading ? 'pl-10' : 'pl-3')
        ->add($iconTrailing ? 'pr-10' : 'pr-3')
        ->add(
            match ($size) {
                'base' => 'h-10 py-2 rounded-lg',
                'sm' => 'h-8 py-1.5 rounded-md',
            },
        )
        ->add('bg-white dark:bg-white/10 dark:disabled:bg-white/[9%]')
        ->add('text-sm text-zinc-700 dark:text-zinc-300')
        ->add('shadow-sm disabled:shadow-none')
        ->add('border border-zinc-200 border-b-zinc-300/80 dark:border-white/10')
        ->add('has-[option.placeholder:checked]:text-zinc-400 dark:has-[option.placeholder:checked]:text-zinc-400');

    $iconLeadingClasses = ZincUi::classes()
        ->add('absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400')
        ->add(
            match ($size) {
                'base' => 'h-8 w-8',
                'sm' => 'h-6 w-8',
            },
        );

    $iconTrailingClasses = ZincUi::classes()
        ->add('absolute right-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400')
        ->add(
            match ($size) {
                'base' => 'h-8 w-8',
                'sm' => 'h-6 w-8',
            },
        );
@endphp

<x-with-field :$id :$error :$label :$description :$badge :$badgeColor>
    <div class="group relative block w-full" data-select>
        <?php if (is_string($iconLeading)): ?>
            <div class="{{ $iconLeadingClasses }}">
                <x-icon :name="$iconLeading" class="ml-2 size-5 shrink-0" />
            </div>
        <?php elseif($iconLeading): ?>
            <div class="{{ $iconLeadingClasses }}">
                {{ $iconLeading }}
            </div>
        <?php endif; ?>

        <select {{ $attributes->class($classes)->merge(['id' => $id, 'type' => $type]) }} data-control data-select-native data-group-target>
            <x-option value="" selected class="placeholder">{{ $placeholder }}</x-option>
            {{ $slot }}
        </select>

        <?php if (is_string($iconTrailing)): ?>
            <div class="{{ $iconTrailingClasses }}">
                <x-icon :name="$iconTrailing" class="mr-2 size-5 shrink-0" />
            </div>
        <?php elseif($iconTrailing): ?>
            <div class="{{ $iconTrailingClasses }}">
                {{ $iconTrailing }}
            </div>
        <?php endif; ?>
    </div>
</x-with-field>
