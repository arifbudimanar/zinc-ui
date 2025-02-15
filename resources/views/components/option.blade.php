@props([
    'variant' => 'default',
    'value' => null,
])
@aware([
    'variant' => $variant,
])

@if ($variant == 'default')
    <option {{ $attributes->class('bg-white dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300')->merge(['value' => $value]) }}>
        {{ $slot }}
    </option>
@endif

@if ($variant == 'listbox')
    <div tabindex="0" role="option" value="{{ $value }}" data-option
        x-on:click="selectedOption = '{{ $value }}'; isSelectOpen = false;"
        x-on:keydown.enter="selectedOption = '{{ $value }}'; isSelectOpen = false;"
        x-on:keydown.space="selectedOption = '{{ $value }}'; isSelectOpen = false;"
        class="group/option overflow-hidden select-none data-[hidden]:hidden group flex items-center px-2 py-1.5 w-full focus:outline-none rounded-md text-left text-sm font-medium text-zinc-800 hover:bg-zinc-100 focus:bg-zinc-100 [&[disabled]]:text-zinc-400 dark:text-white hover:dark:bg-zinc-600 focus:dark:bg-zinc-600 dark:[&[disabled]]:text-zinc-400 scroll-my-[.3125rem]">
        <div class="w-7 shrink-0">
            <template x-if="selectedOption === '{{ $value }}'">
                <x-icon name="m-check" class="size-5 shrink-0" />
            </template>
        </div>
        {{ $slot }}
    </div>
@endif
