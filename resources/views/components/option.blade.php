@props([
    'variant' => 'default',
    'value' => null,
    'multiple' => false,
])

@aware([
    'variant' => $variant,
    'multiple' => $multiple,
])

@php
    $classes = ZincUi::classes()->add(
        match ($variant) {
            'default' => 'bg-white dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 [&[disabled]]:text-zinc-500 dark:[&[disabled]]:text-zinc-500',
            'listbox' => [
                'group/option overflow-hidden select-none group',
                'flex items-center px-2 py-1.5 w-full rounded-md',
                'text-left text-sm font-medium text-zinc-800 dark:text-white',
                '[&[disabled]]:text-zinc-400 dark:[&[disabled]]:text-zinc-400 [&[disabled]]:pointer-events-none',
                'focus:outline-hidden focus:bg-zinc-100 focus:dark:bg-zinc-600',
                'hover:bg-zinc-100 hover:dark:bg-zinc-600',
                'scroll-my-[.3125rem]',
            ],
        },
    );
@endphp

<?php if ($variant == 'default'): ?>
<option {{ $attributes->class($classes)->merge(['value' => $value]) }}>
    {{ $slot }}
</option>
<?php endif; ?>

<?php if ($variant == 'listbox'): ?>
<?php if ($multiple): ?>
<button type="button" role="option" value="{{ $value }}" {{ $attributes->class($classes) }}
    x-on:click="selectedOptions.includes('{{ $value }}') ? selectedOptions = selectedOptions.filter(option => option !== '{{ $value }}') : selectedOptions = [...selectedOptions, '{{ $value }}'];"
    x-on:keydown.space.prevent="$el.click()" data-option>
    <div class="w-7 shrink-0">
        <template x-if="selectedOptions.includes('{{ $value }}')">
            <x-icon name="m-check" class="size-5 shrink-0" />
        </template>
    </div>

    {{ $slot }}
</button>
<?php else: ?>
<button type="button" role="option" value="{{ $value }}" {{ $attributes->class($classes) }}
    x-on:click="if (selectedOption === '{{ $value }}') { selectedOption = null; } else { selectedOption = '{{ $value }}'; isSelectOpen = false; }"
    x-on:keydown.space.prevent="$el.click()" data-option>
    <div class="w-7 shrink-0">
        <template x-if="selectedOption === '{{ $value }}'">
            <x-icon name="m-check" class="size-5 shrink-0" />
        </template>
    </div>

    {{ $slot }}
</button>
<?php endif; ?>
<?php endif; ?>
