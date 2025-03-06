@props([
    'variant' => 'default',
    'name' => null,
    'dismissable' => true,
    'closeable' => true,
    'position' => 'right',
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $name = Str::kebab($name ?? $wireModel);

    $dialogClasses = ZincUi::classes()
        ->add('bg-white dark:bg-zinc-800 shadow-md')
        ->add(
            match ($variant) {
                'default' => 'fixed z-10 p-6 m-6 lg:m-8 rounded-xl',
                'flyout' => 'fixed z-10 p-6 lg:p-8 overflow-y-auto',
            },
        )
        ->add(
            match ($variant) {
                'default' => 'border border-transparent dark:border-zinc-700',
                'flyout' => 'border-transparent dark:border-zinc-700',
            },
        )
        ->add(
            match ($variant) {
                'default' => '[:where(&)]:max-w-xl [:where(&)]:max-h-[calc(100vh-1.5rem)] [:where(&)]:lg:max-h-[calc(100vh-2rem)]',
                'flyout' => match ($position) {
                    'top' => 'top-0 min-w-[100vw] [:where(&)]:max-h-[calc(100vh-2rem)] border-b',
                    'bottom' => 'bottom-0 min-w-[100vw] [:where(&)]:max-h-[calc(100vh-2rem)] border-t',
                    'left' => 'left-0 min-h-[100vh] [:where(&)]:max-w-xl border-r max-w-96',
                    'right' => 'right-0 min-h-[100vh] [:where(&)]:max-w-xl border-l max-w-96',
                },
            },
        );

    $modalClasses = ZincUi::classes()->add(
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
    <div x-show="isModalOpen" x-cloak class="{{ $modalClasses }}" data-modal>
        <x-overlay data-modal-overlay/>

        <div {{ $attributes->class($dialogClasses) }}
            <?php if ($dismissable): ?>
                x-on:click.outside="isModalOpen = false"
            <?php endif; ?>

            x-show="isModalOpen"
            x-trap.inert.noscroll="isModalOpen"
            x-on:keydown.esc.stop="isModalOpen = false"

            <?php if ($variant == 'default'): ?>
                x-transition:enter="transform ease-out duration-100"
                x-transition:enter-start="translate-y-5 opacity-90"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transform ease-in duration-100"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-5 opacity-0"
            <?php endif; ?>

            <?php if ($variant == 'flyout'): ?>
                <?php if ($position == 'left'): ?>
                    x-transition:enter="transform ease-out duration-100"
                    x-transition:enter-start="-translate-x-full opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    x-transition:leave="transform ease-in duration-100"
                    x-transition:leave-start="translate-x-0 opacity-100"
                    x-transition:leave-end="-translate-x-full opacity-0"
                <?php elseif ($position == 'right'): ?>
                    x-transition:enter="transform ease-out duration-100"
                    x-transition:enter-start="translate-x-full opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    x-transition:leave="transform ease-in duration-100"
                    x-transition:leave-start="translate-x-0 opacity-100"
                    x-transition:leave-end="translate-x-full opacity-0"
                <?php elseif ($position == 'top'): ?>
                    x-transition:enter="transform ease-out duration-100"
                    x-transition:enter-start="-translate-y-full opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transform ease-in duration-100"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="-translate-y-full opacity-0"
                <?php elseif ($position == 'bottom'): ?>
                    x-transition:enter="transform ease-out duration-100"
                    x-transition:enter-start="translate-y-full opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transform ease-in duration-100"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-full opacity-0"
                <?php endif; ?>
            <?php endif; ?> data-modal-dialog>

            {{ $slot }}

            <?php if ($closeable): ?>
                <?php if ($variant == 'flyout'): ?>
                    <x-modal.close class="absolute top-0 right-0 mt-4 mr-4 lg:mt-6 lg:mr-6">
                        <x-button variant="ghost" size="sm" icon="o-x-mark" />
                    </x-modal.close>
                <?php else: ?>
                    <x-modal.close class="absolute top-0 right-0 mt-4 mr-4">
                        <x-button variant="ghost" size="sm" icon="o-x-mark" />
                    </x-modal.close>
                <?php endif; ?>
            <?php endif; ?>
            </div>
    </div>
</div>
