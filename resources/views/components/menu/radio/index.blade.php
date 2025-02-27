@props([
    'id' => null,
    'type' => 'radio',
    'name' => null,
    'variant' => 'default',
    'indent' => false,
    'suffix' => null,
    'label' => null,
    'icon' => null,
    'kbd' => null,
])

@aware([
    'name' => $name,
])

@php
    if ($kbd) {
        $suffix = $kbd;
    }
    $id = $id ?? ($label ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $name ??= $attributes->whereStartsWith('wire:model')->first();

    $classes = ZincUi::classes()
        ->add('group/menu-checkbox flex items-center px-2 py-1.5 w-full focus:outline-hidden')
        ->add('rounded-md')
        ->add('cursor-pointer')
        ->add('text-left text-sm font-medium')
        ->add('[&:has([data-menu-checkbox]:disabled)]:opacity-50 [&:has([data-menu-checkbox]:disabled)]:cursor-default')
        ->add([
            'text-zinc-800 hover:bg-zinc-50 focus:bg-zinc-50 dark:text-white hover:dark:bg-zinc-600 focus:dark:bg-zinc-600',
            '[&_[data-menu-radio-icon]]:text-zinc-400 dark:[&_[data-menu-radio-icon]]:text-white/60 [&:hover_[data-menu-radio-icon]]:text-current [&:focus_[data-menu-radio-icon]]:text-current',
        ]);
@endphp

<div tabindex="0" role="button"
    x-on:click="$el.querySelector('input').click();"
    x-on:keydown.space.prevent="$el.querySelector('input').click()"
    x-on:keydown.enter.prevent="$el.querySelector('input').click()"
    x-bind:tabindex="$el.querySelector('input').disabled ? '-1' : '0'"
    x-bind:aria-disabled="$el.querySelector('input').disabled ? 'true' : 'false'"
    class="{{ $classes }}"
    data-menu-item-has-icon>
    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type, 'name' => $name]) }} data-menu-checkbox>

    <div class="w-7 peer-checked:[&_[data-menu-radio-indicator]]:block">
        <div class="hidden" data-menu-radio-indicator>
            <?php if (is_string($icon) && $icon !== ''): ?>
            <x-icon :$icon class="size-5 shrink-0" data-menu-radio-icon />
            <?php elseif ($icon == null): ?>
            <x-icon icon="o-check" class="size-5 shrink-0" data-menu-radio-icon />
            <?php else: ?>
            {{ $icon }}
            <?php endif; ?>
        </div>
    </div>

    {{ $label ?? $slot }}

    <?php if (is_string($suffix) && $suffix != ''): ?>
    <div class="ml-auto">
        <x-kbd class="ml-2 hidden opacity-50 lg:block">
            {{ $suffix }}
        </x-kbd>
    </div>
    <?php else: ?>
    <div class="ml-auto">
        {{ $suffix }}
    </div>
    <?php endif; ?>
</div>
