@props([
    'variant' => 'default',
    'name' => null,
    'dismissable' => true,
    'position' => 'right',
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $name = Str::kebab($name ?? $wireModel);

    $classes = ZincUi::classes()
        ->add(
            match ($variant) {
                'default'
                    => 'relative fixed z-10 p-6 m-6 lg:m-8 overflow-y-auto [:where(&)]:max-w-xl max-h-[calc(100vh-1.5rem)] lg:max-h-[calc(100vh-2rem)] shadow-lg rounded-xl bg-white dark:bg-zinc-800 border border-transparent dark:border-zinc-700',
                'flyout' => 'fixed z-10 m-0 p-6 lg:p-8 overflow-y-auto max-h-[100vh] mt-auto shadow-lg bg-white dark:bg-zinc-800 border-transparent dark:border-zinc-700',
            },
        )
        ->add(
            $variant === 'flyout'
                ? match ($position) {
                    'top' => 'top-0 min-w-[100vw] border-b',
                    'bottom' => 'bottom-0 min-w-[100vw] border-t',
                    'left' => 'left-0 min-h-[100vh] border-r',
                    'right' => 'right-0 min-h-[100vh] border-l',
                }
                : '',
        );

    $wrapperClasses = ZincUi::classes()->add(
        match ($variant) {
            'default' => 'fixed inset-0 z-30 flex items-center justify-center',
            'flyout' => 'fixed inset-0 z-30',
        },
    );
@endphp

<div
    x-data="{
        isModalOpen: {{ $wireModel ? '$wire.entangle(\'' . $wireModel . '\')' : 'false' }}
    }"
    x-on:open-modal-{{ $name }}.window="isModalOpen = true"
    x-on:close-modal-{{ $name }}.window="isModalOpen = false">
    <div x-show="isModalOpen" x-cloak class="{{ $wrapperClasses }}">
        <x-overlay />

        <div {{ $attributes->class($classes) }}
            @if ($dismissable) x-on:click.outside="isModalOpen = false" @endif
            x-show="isModalOpen"
            x-trap.inert.noscroll="isModalOpen"
            x-on:keydown.esc.stop="isModalOpen = false"
            @if ($variant == 'default') x-transition:enter="transform ease-out duration-75"
                x-transition:enter-start="translate-y-5 opacity-90"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transform ease-in duration-75"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-5 opacity-0"
            @elseif($variant == 'flyout')
                @if ($position == 'left')
                    x-transition:enter="transform ease-out duration-75"
                    x-transition:enter-start="-translate-x-full opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    x-transition:leave="transform ease-in duration-75"
                    x-transition:leave-start="translate-x-0 opacity-100"
                    x-transition:leave-end="-translate-x-full opacity-0"
                @elseif($position == 'right')
                    x-transition:enter="transform ease-out duration-75"
                    x-transition:enter-start="translate-x-full opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    x-transition:leave="transform ease-in duration-75"
                    x-transition:leave-start="translate-x-0 opacity-100"
                    x-transition:leave-end="translate-x-full opacity-0"
                @elseif($position == 'top')
                    x-transition:enter="transform ease-out duration-75"
                    x-transition:enter-start="-translate-y-full opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transform ease-in duration-75"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="-translate-y-full opacity-0"
                @elseif($position == 'bottom')
                    x-transition:enter="transform ease-out duration-75"
                    x-transition:enter-start="translate-y-full opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transform ease-in duration-75"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-full opacity-0" @endif
            @endif
            data-modal>
            {{ $slot }}

            @if ($variant == 'flyout')
                <x-modal.close hidden class="absolute top-0 right-0 mt-4 mr-4 lg:mt-6 lg:mr-6 [&[hidden]]:block">
                    <x-button variant="ghost" size="sm" icon="o-x-mark" />
                </x-modal.close>
            @else
                <x-modal.close hidden class="absolute top-0 right-0 mt-4 mr-4 [&[hidden]]:block">
                    <x-button variant="ghost" size="sm" icon="o-x-mark" />
                </x-modal.close>
            @endif
        </div>
    </div>
</div>
