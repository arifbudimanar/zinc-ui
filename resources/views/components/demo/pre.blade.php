@props([
    'copyable' => false,
    'scrollable' => false,
])

@php
    $heightClass = $scrollable ? 'max-h-80' : '';
@endphp

@if ($copyable)
    <div class="relative rounded-b-lg bg-zinc-50 dark:bg-zinc-800" x-data="{
        isCopied: false,
        copyCode() {
            let copyText = this.$refs.copyCode;
            navigator.clipboard.writeText(copyText.textContent);
            this.isCopied = true;
            setTimeout(() => this.isCopied = false, 1000);
        }
    }">
        <div class="absolute top-3 right-3">
            <x-tooltip position="top">
                <x-tooltip.content class="whitespace-nowrap">
                    {{ __('Copy to clipboard') }}
                </x-tooltip.content>
                <x-button size="sm" x-on:click="copyCode()" x-bind:class="isCopied && 'pointer-events-none'">
                    <x-slot:icon>
                        <x-icon name="o-clipboard" class="inline-flex items-center shrink-0 size-5" x-show="!isCopied" />
                        <x-icon name="o-check" class="inline-flex items-center shrink-0 size-5" x-cloak
                            x-show="isCopied" />
                    </x-slot:icon>
                </x-button>
            </x-tooltip>
        </div>
        <div {{ $attributes->merge(['class' => 'w-full overflow-auto' . ' ' . $heightClass]) }} x-ref="copyCode">
            {{ $slot }}
        </div>
    </div>
@else
    <div class="rounded-b-lg bg-zinc-50 dark:bg-zinc-800">
        <div {{ $attributes->merge(['class' => 'w-full overflow-auto' . ' ' . $heightClass]) }}>
            {{ $slot }}
        </div>
    </div>
@endif
