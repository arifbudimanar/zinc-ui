@props([
    'variant' => 'default',
    'name' => null,
    'dismissable' => true,
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $name = Str::kebab($name ?? $wireModel);

    $classes = ZincUi::classes()->add('relative p-6 [:where(&)]:max-w-xl shadow-lg rounded-xl bg-white dark:bg-zinc-800 border border-transparent dark:border-zinc-700');
@endphp

<div
    x-data="{
        isModalOpen: {{ $wireModel ? '$wire.entangle(\'' . $wireModel . '\')' : 'false' }}
    }"
    x-on:open-modal-{{ $name }}.window="isModalOpen = !isModalOpen">
    <x-overlay
        x-show="isModalOpen"
        x-trap.inert.noscroll="isModalOpen"
        class="z-30 flex items-center justify-center h-screen w-screen">
        <div {{ $attributes->class($classes)->except('wire:model') }}
            @if ($dismissable) x-on:click.outside="isModalOpen = false" @endif
            x-on:keydown.esc="isModalOpen = false" data-modal>
            {{ $slot }}
            {{-- @dump($name, $wireModel) --}}

            <x-modal.close hidden class="absolute top-0 right-0 mt-4 mr-4 [&[hidden]]:block">
                <x-button variant="ghost" size="sm" icon="o-x-mark" />
            </x-modal.close>
        </div>
    </x-overlay>
</div>
