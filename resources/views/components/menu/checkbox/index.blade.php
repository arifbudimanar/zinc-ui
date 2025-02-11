@props([
    'id' => null,
    'type' => 'checkbox',
    'variant' => 'default',
    'indent' => false,
    'suffix' => null,
    'label' => null,
    'icon' => null,
    'kbd' => null,
])

@php
    if ($kbd) {
        $suffix = $kbd;
    }
    $id = $id ?? ($label ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));

    $classes = ZincUi::classes()
        ->add('group/menu-checkbox flex items-center px-2 py-1.5 w-full focus:outline-none')
        ->add('rounded-md')
        ->add('cursor-pointer')
        ->add('text-left text-sm font-medium')
        ->add('[&:has(input[data-menu-checkbox]:disabled)]:opacity-50 [&:has(input[data-menu-checkbox]:disabled)]:cursor-default')
        ->add([
            'text-zinc-800 hover:bg-zinc-50 focus:bg-zinc-50 dark:text-white hover:dark:bg-zinc-600 focus:dark:bg-zinc-600',
            '[&_[data-menu-checkbox-icon]]:text-zinc-400 dark:[&_[data-menu-checkbox-icon]]:text-white/60 [&:hover_[data-menu-checkbox-icon]]:text-current [&:focus_[data-menu-checkbox-icon]]:text-current',
        ]);
@endphp

<div tabindex="0" role="button"
    x-on:click="$el.querySelector('input').click()"
    x-on:keydown.space.prevent="$el.querySelector('input').click()"
    x-on:keydown.enter.prevent="$el.querySelector('input').click()"
    x-bind:tabindex="$el.querySelector('input').disabled ? '-1' : '0'"
    x-bind:aria-disabled="$el.querySelector('input').disabled ? 'true' : 'false'"
    class="{{ $classes }}"
    data-menu-item-has-icon>
    <input {{ $attributes->class('peer sr-only hidden')->merge(['id' => $id, 'type' => $type]) }} data-menu-checkbox>

    <div class="w-7 peer-checked:[&_[data-menu-checkbox-indicator]]:block">
        <div class="hidden" data-menu-checkbox-indicator>
            <x-icon icon="o-check" class="size-5 shrink-0" data-menu-checkbox-icon />
        </div>
    </div>

    {{ $label ?? $slot }}

    <?php if ($suffix): ?>
    <div class="ml-auto opacity-50 text-xs">
        {{ $suffix }}
    </div>
    <?php endif; ?>
</div>
